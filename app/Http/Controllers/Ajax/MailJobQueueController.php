<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use DataTables;
use Carbon\Carbon;
use App\Models\MailJobs;
use Mail;


class MailJobQueueController extends Controller
{
    public function queue()
    {
      if(MailJobs::count() > 0)
      {
        $process = new Process('php artisan queue:work --once');
        $process->setWorkingDirectory(base_path());
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
          return response([
            'status' => 'error',
            'message' => 'An error occurred!',
          ], 500);
        }else{
          return response([
            'status' => true,
            'message' => 'successfull !',
          ]);
        }
      }
      return response([
        'status' => true,
        'message' => 'hmmmm !',
      ]);
    }
}
