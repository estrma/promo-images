<?php

use Intervention\Image\ImageManager;

class PromoImage
{
    public $manager;
    private $font_path;
    private $frame_path;
    public $img;

    function __construct()
    {
        $this->manager = new ImageManager();
        $this->font_path = __DIR__ . '/assets/Barlow-Regular.ttf';
        $this->frame_path = __DIR__ . '/assets/ramka.png';
    }

    public function compose($data)
    {
        $image = $data['image'];

        $font_path = $this->font_path;
        $frame = $this->frame_path;

        $w = 886;
        $h = 886;

        $img = $this->manager->canvas($w, $h, '#ccc');

        $thumb = $this->manager->make($image)->fit(800, 800);
        $img->insert($thumb, 'center');
        $img->insert($frame);

        $img->text(mb_strtoupper($data['show']), 75, 55, function ($font) use ($font_path) {
            $font->file($font_path);
            $font->size(38);
            $font->color('#000');
            $font->align('left');
            $font->valign('top');
        });

        $img->text(mb_strtoupper($data['title']), 75, 95, function ($font) use ($font_path) {
            $font->file($font_path);
            $font->size(38);
            $font->color('#000');
            $font->align('left');
            $font->valign('top');
        });

        $img->text(mb_strtoupper($data['date']), 45, 805, function ($font) use ($font_path) {
            $font->file($font_path);
            $font->size(29);
            $font->color('#000');
            $font->align('left');
            $font->valign('top');
        });

        $img->text(mb_strtoupper($data['time']), 45, 835, function ($font) use ($font_path) {
            $font->file($font_path);
            $font->size(29);
            $font->color('#000');
            $font->align('left');
            $font->valign('top');
        });

        $this->img = $img;
        return $this;
    }

    public function serve()
    {
        header('Content-Type: image/png');
        echo $this->img->encode('png');
    }

    public function save($destination = 'example/img.png')
    {
        $this->img->save($destination);
    }
}
