<?php

namespace App\Console\Commands;
use App\User;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Environment;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTenant extends Command
{
    protected $signature = 'tenant:create {name} {email} {tenantname}';
    protected $description = 'Creates a tenant with the provided name and email address e.g. php artisan tenant:create john john@example.com cafejohn';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $tenantname = $this->argument('tenantname');
        if ($this->tenantExists($tenantname)) {
            $this->error("A tenant with name '{$tenantname}' already exists.");
            return;
        }
        $tenant = $this->registerTenant($name, $email, $tenantname);
        app(Environment::class)->tenant($tenant["website"]);

        // we'll create a random secure password for our to-be admin
        $password = str_random();
        $this->addAdmin($name, $email, $password);
        $this->info("Tenant '{$tenantname}' is created and is now accessible at {$tenant["hostname"]->fqdn}");
        $this->info("Admin {$email} can log in using password {$password}");
    }

    private function tenantExists($tenantname)
    {
        $baseUrl = config('app.url_base');
        $fqdn = "{$tenantname}.{$baseUrl}";
        return Hostname::where('fqdn', $fqdn)->exists();
    }

    private function registerTenant($name, $email, $tenantname)
    {
        // create a website
        $website = new Website;
        app(WebsiteRepository::class)->create($website);
        // associate the website with a hostname
        $hostname = new Hostname;
        $baseUrl = config('app.url_base');
        $hostname->fqdn = "{$tenantname}.{$baseUrl}";
        app(HostnameRepository::class)->attach($hostname, $website);
        return ["hostname"=>$hostname, "website"=>$website];
    }

    private function addAdmin($name, $email, $password)
    {
        $admin = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $admin->guard_name = 'web';
        $admin->assignRole('admin');
        return $admin;
    }
}
