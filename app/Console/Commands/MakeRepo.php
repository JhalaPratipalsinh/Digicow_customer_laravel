<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
class MakeRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ceate Service Repository And Interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');

        $path = $this->viewPath($file);
        $interpath = $this->interpath($file);
        $this->createDir($path);
        $this->createinter($interpath);

        if (File::exists($path))
        {
            $this->error("File {$path} already exists!");
            return;
        }
        if (File::exists($interpath)) {
            $this->error("File {$interpath} already exists!");
        }
        $interfacename = ucfirst($file).'Interface';
        $interface = 'use App\Repositories\Interfaces\\'.$interfacename.';';
        $data = '<?php
namespace App\Repositories\Repository;

'.$interface.'

class '.ucfirst($file).' implements '.ucfirst($file).'Interface
{
    //code
}';

$inter = '<?php

namespace App\Repositories\Interfaces;

interface '.$interfacename.'
{
    //code
}
';
        File::put($path, $data);
        File::put($interpath, $inter);

        $this->info("File {$path} created.");
        $this->info("File {$interpath} created.");

    }
         /**
     * Get the view full path.
     *
     * @param string $file
     *
     * @return string
     */
    public function viewPath($file)
    {
        $file = str_replace('.','/',$file);

        $view = ucfirst($file) . '.php';

        $path = "App/Repositories/Repository/{$view}";

        return $path;
    }

    public function interpath($file)
    {
        $file = str_replace('.','/',$file);
        $view = ucfirst($file) . 'Interface.php';

        $path = "App/Repositories/Interfaces/{$view}";

        return $path;
    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }

    public function createinter($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }
}
