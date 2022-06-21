<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use App\Models\User;
use App\Notifications\TestEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;

class SettingController extends Controller
{
    // admin dashboard
    public function dashboard()
    {
        // users history
        $data['total_users'] = User::where('role_id', 0)->count();
        $data['30days_users'] = User::where('role_id', 0)->where('created_at', '>=', now()->subDays(30))->count();

        $data['30days_user_percentage'] = $this->Percentage($data['30days_users'], $data['total_users']);

        $data['today_users'] = User::where('role_id', 0)->where('created_at', '>=', today())->count();

        $data['today_users_percentage'] = $this->Percentage($data['today_users'], $data['30days_users']);
        // medication history
        $data['total_medications'] = Medication::count();
        $data['30_days_medications'] = Medication::where('created_at', '>=', now()->subDays(30))->count();
        $data['30_days_medications_percentage'] = $this->Percentage($data['30_days_medications'], $data['total_medications']);
        $data['today_medications'] = Medication::where('created_at', '>=', today())->count();
        $data['today_medications_percentage'] = $this->Percentage($data['today_medications'], $data['30_days_medications']);

        // top 5 users
        $data['users'] = User::where('role_id', 0)->latest()->limit(5)->get(['name', 'email', 'phone', 'date_of_birth']);

        // top 5 medications
        $data['medications'] = Medication::latest()->limit(5)->get();

        // dd($data['users']);
        return view('admin.dashboard', compact('data'));
    }

    // showing setting index page
    public function index()
    {
        $data['generals'] =  [
            'APP_NAME' => env('APP_NAME'),
            'APP_URL' => env('APP_URL'),
            'SUBSCRIPTION_PRICE' => env('SUBSCRIPTION_PRICE'),
            // 'DB_HOST' => env('DB_HOST'),
            // 'DB_PORT' => env('DB_PORT'),
            // 'DB_DATABASE' => env('DB_DATABASE'),
            // 'DB_USERNAME' => env('DB_USERNAME'),
            // 'DB_PASSWORD' => env('DB_PASSWORD'),
            'STRIPE_KEY' => env('STRIPE_KEY'),
            'STRIPE_SECRET' => env('STRIPE_SECRET'),
        ];
        $data['email'] =  [
            'MAIL_DRIVER' => env('MAIL_DRIVER'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
        ];
        return view('admin.settings.index', compact('data'));
    }

    // updating general env settings
    public function updateGeneral(Request $request)
    {
        $array = $request->all();
        $veriables = array_splice($array, 1);
        $this->update_env($veriables);
        Artisan::call("cache:clear");
        Artisan::call("config:clear");

        return redirect()->back();
    }

    // sending test email
    public function testEmail(Request $request)
    {
        Notification::route('mail', $request->email)
            ->notify(new TestEmailNotification());
        return redirect()->back()->with('email', 'Email is send successfully!');
    }

    private function update_env($data = []): void
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            foreach ($data as $key => $value) {
                file_put_contents($path, str_replace(
                    $key . '=' . "'" . env($key) . "'",
                    $key . '=' . "'" . $value . "'",
                    file_get_contents($path)
                ));
            }
        }
    }

    // find perentange
    private function Percentage($first, $second)
    {
        $second = $second == 0 ? 1 : $second;
        $percentage = ($first * 100) / $second;
        return number_format($percentage, 2);
    }
}
