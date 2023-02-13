<?php
    function makeDirectory($path)
    {
        if (file_exists($path)) return true;
        return mkdir($path, 0755, true);
    }

    function removeFile($path)
    {
        return file_exists($path) && is_file($path) ? @unlink($path) : false;
    }

    function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
    {
        $path = makeDirectory($location);
        if (!$path) throw new Exception('File could not been created.');

        if (!empty($old)) {
            removeFile($location . '/' . $old);
            removeFile($location . '/thumb_' . $old);
        }

        $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();

        $image = Image::make($file);

        if (!empty($size)) {
            $size   = explode('x', strtolower($size));
            $width  = $size[0];
            $height = $size[1];

            $canvas = Image::canvas($width, $height);

            $image = $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            $canvas->insert($image, 'center');
            $canvas->save($location . '/' . $filename);
        }else{
            $image->save($location . '/' . $filename);
        }

        if (!empty($thumb)) {
            $thumb = explode('x', $thumb);
            Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
        }

        return $filename;
    }



if (!function_exists('getServiceStatus')) {
    /**
     * Helper to grab the status name for request
     *
     * @return string
     */
    function getServiceStatus($key): string
    {
        return config('default.request.status')[$key] ?? 'Not found';
    }
}



if (!function_exists('readableDate')) {
    /**
     * Helper to grab the status name for request
     *
     * @return string
     */
    function humanReadableDate($date)
    {
        if ($date) {
            return \Carbon\Carbon::parse($date)->diffForHumans();
        }
    }
}


