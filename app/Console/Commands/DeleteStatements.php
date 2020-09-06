<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\NoticeMail;

class DeleteStatements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:statements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina declaraciones';

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
     * @return int
     */
    public function handle()
    {
        $statements = \App\Statement::pluck("id")->toArray();
        if (!empty($statements)) {
            $total = count($statements);
            $ids = implode(", ", $statements);
            Mail::to(NOTICE)->send(new NoticeMail([
                "logo" => asset(\App\Rig::first()->images["logo"]["i"]),
                "data" => [
                    "declaracions" => "Cron de declaraciones activo. Se bajarán en total: {$total}. ID: {$ids}"
                ]
            ]));
            (new \App\Log)->create("statements", null, "Baja lógica de declaraciones", null, "N");
            (new \App\Statement)->whereIn("id", $statements)->delete();
        }
    }
}
