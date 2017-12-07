<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Hyn\Tenancy\Traits\UsesSystemConnection;

use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Environment;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;

class Blog extends Model
{
    use UsesSystemConnection;

    protected $fillable = ['name', 'slug', 'website_id'];

    public static function create($data){

        $slug = str_slug($data['name']);

        $website = new Website;
        $website->uuid = config('app.name') . "_" . $slug;
        app(WebsiteRepository::class)->create($website);

        $hostname = new Hostname;
        $hostname->fqdn =  $slug . '.' . config('tenancy.hostname.default');
        app(HostnameRepository::class)->attach($hostname, $website);

        return static::query()->create(array_merge($data, ['slug' => $slug, 'website_id' => $website->id]));
    }

    public function website()
    {
        $website = Website::findOrFail($this->website_id);
        return $website;
    }

    public function url()
    {
        $url = "http://" . $this->website()->hostnames[0]->fqdn;
        return $url;
    }
}
