<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Blog;
use App\Article;

use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Environment;

use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //suppression du contenu des tables
        DB::table('users')->delete();
        DB::table('blogs')->delete();
        DB::table('websites')->delete();
        DB::table('hostnames')->delete();
        DB::table('customers')->delete();

        // Suppression de toutes les bases de données dont le nom commence par "multitenant_"
        $databases = DB::connection()->select('SELECT TABLE_SCHEMA FROM information_schema.tables WHERE TABLE_SCHEMA LIKE "multitenant_%"');
        foreach ($databases as $database) {
            DB::connection()->statement('DROP DATABASE IF EXISTS `' . $database->TABLE_SCHEMA . '`');
        }

        $fakeUser = User::create(array(
            'name'      => 'FakeUser',
            'email'     => 'fake@user.com',
            'password'  => bcrypt('secret')
        ));

        $blog = Blog::create(array(
            'name'      => 'Premier Blog',
        ));

        // Switch to 'Premier Blog' tenant
        $tenancy = app(Environment::class);
        $tenancy->hostname($blog->website()->hostnames[0]);

        $article = Article::create(array(
            'title'     => 'Premier Article',
            'content'   => 'Contenu du premier article',
        ));
    }
}
