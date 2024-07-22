<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Notification;
use App\Models\Suspect;
use App\Services\FirebaseService;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function sendPushNotification(Request $request)
    {
      /*   $request->validate([
            'device_id' => 'required|exists:devices,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $device = Device::findOrFail($request->device_id);

        if (!$device->fcm_token) {
            return response()->json(['error' => 'Device does not have a valid FCM token'], 400);
        }

        // Guardar la notificación en la base de datos
        $notification = Notification::create([
            'device_id' => $device->id,
            'title' => $request->title,
            'description' => $request->description,
            'notification_time' => now(),
            'read' => false,
        ]);

        $this->firebaseService->sendNotification($device->fcm_token, $request->title, $request->description);

        return response()->json([
            'message' => 'Notification sent successfully',
            'notification' => $notification,
        ]); */

        $request->validate([
            'serial' => 'required|exists:devices,serial',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $device = Device::where('serial', $request->serial)->firstOrFail();

        if (!$device->fcm_token) {
            return response()->json(['error' => 'Device does not have a valid FCM token'], 400);
        }

        // Guardar la notificación en la base de datos
        $notification = Notification::create([
            'device_id' => $device->id,
            'title' => $request->title,
            'description' => $request->description,
            'notification_time' => now(),
            'read' => false,
        ]);

        // Enviar la notificación utilizando el servicio de Firebase
        $this->firebaseService->sendNotification($device->fcm_token, $request->title, $request->description);

        return response()->json([
            'message' => 'Notification sent successfully',
            'notification' => $notification,
        ]);
    }

    public function getNotifications(Request $request)
    {
        $request->validate(['serial' => 'required|exists:devices,serial']);
        $serial = $request->input('serial');

        $device = Device::where('serial', $serial)->firstOrFail();
        $notifications = Notification::where('device_id', $device->id)->get();

        return response()->json($notifications);
    }

    public function markAsRead(Request $request)
    {
        $request->validate([
            'notification_id' => 'required|exists:notifications,id'
        ]);

        $notification = Notification::findOrFail($request->notification_id);
        $notification->read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read']);
    }




    public function showNotificationForm(Request $request)
{
    $query = Suspect::query();

    // Si hay un filtro de suspect, aplicarlo
    if ($request->filled('suspect_name')) {
        $query->where('name', 'like', '%' . $request->suspect_name . '%');
    }

    $suspects = $query->with('device')->get();
    //dd($suspects);
    return view('admin.send', compact('suspects'));
}

public function sendNotification(Request $request)
{
    $request->validate([
        'suspect_id' => 'required|exists:suspects,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    $suspect = Suspect::findOrFail($request->suspect_id);
    $device = $suspect->device;

    if (!$device || !$device->fcm_token) {
        return redirect()->back()->with('error', 'Suspect does not have a valid device with FCM token');
    }

    // Guardar la notificación en la base de datos
    $notification = Notification::create([
        'device_id' => $device->id,
        'title' => $request->title,
        'description' => $request->description,
        'notification_time' => now(),
        'read' => false,
    ]);

    $this->firebaseService->sendNotification($device->fcm_token, $request->title, $request->description);

    return redirect()->back()->with('success', 'Notification sent successfully');
}

}
