<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertNotification;
use App\Models\Alert;
use App\Models\Device;
use App\Models\User;
use Carbon\Carbon;
class CheckDeviceConnections extends Command
{
    protected $signature = 'check:device-connections';
    protected $description = 'Check devices for lost connections';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $threshold = Carbon::now()->subMinutes(20); // Ajustar el tiempo según sea necesario
        $devices = Device::where('updated_at', '<', $threshold)->has('suspect')->get();
        $admin = User::find(1);
        
        foreach ($devices as $device) {
            $suspect = $device->suspect;

            if ($suspect) {
                // Verificar y actualizar el estado de conexión del dispositivo
                $alert = Alert::firstOrCreate(['device_id' => $device->id]);
                $wasDisconnected = $alert->currently_pulseless;

                if ($device->updated_at < $threshold) {
                    if (!$wasDisconnected) {
                        $alert->pulseless_count++;
                        $alert->currently_pulseless = true;

                        $message = 'Suspect ' . $suspect->name . ' ' . $suspect->lastname . '\'s device has lost connection';
                        Mail::to($suspect->email)->send(new AlertNotification($message));
                        Mail::to($admin->email)->send(new AlertNotification($message));
                    }
                }

                $alert->save();
            }
        }

        $this->info('Device connections checked successfully.');
    }
}
