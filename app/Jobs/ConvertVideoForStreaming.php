<?php

namespace App\Jobs;

use App\Models\Video;
use Carbon\Carbon;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $videoFormat = new X264('libmp3lame', 'libx264');
        // create some video formats...
        $lowBitrateFormat  = ($videoFormat)->setKiloBitrate(500);
        $midBitrateFormat  = ($videoFormat)->setKiloBitrate(1500);
        $highBitrateFormat = ($videoFormat)->setKiloBitrate(3000);

        // open the uploaded video from the right disk...
        FFMpeg::fromDisk('public')
            ->open($this->video->video_path)

        // call the 'exportForHLS' method and specify the disk to which we want to export...
            ->exportForHLS()
            ->toDisk('streamable_videos')

        // we'll add different formats so the stream will play smoothly
        // with all kinds of internet connections...
            ->addFormat($lowBitrateFormat)
            ->addFormat($midBitrateFormat)
            ->addFormat($highBitrateFormat)

        // call the 'save' method with a filename...
            ->save($this->video->id . '.m3u8');

        // update the database so we know the convertion is done!
        // $this->video->update([
        //     'converted_for_streaming_at' => Carbon::now(),
        // ]);
    }
}
