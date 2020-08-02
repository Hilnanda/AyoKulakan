<?php

namespace App\Models\Traits;

use App\Models\Attachments;
use App\Models\Embed;
use App\Models\Files;
use App\Models\Picture;
use App\Models\PictureUsers;

trait RaidModel
{
    public function scopeSort($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public static function prepare($request, $identifier = 'id')
    {
        $record = new static;

        if ($request->has($identifier) && $request->get($identifier) != null && $request->get($identifier) != 0) {
            $record = static::find($request->get($identifier));
        }

        return $record;
    }

    public function getAttachment()
    {
        $string = '';

        if($this->attachment->count() > 0)
        {
            foreach($this->attachment as $key => $attachment)
            {
                if($key == 0)
                {
                    $string .= $attachment->filename;
                }else{
                    $string .= ','.$attachment->filename;
                }
            }
        }

        return $string;
    }

    public function getEmbed()
    {
        $string = '';

        if($this->embed->count() > 0)
        {
            foreach($this->embed as $key => $embed)
            {
                if($key == 0)
                {
                    $string .= $embed->embed;
                }else{
                    $string .= ','.$embed->embed;
                }
            }
        }

        return $string;
    }

    public function getOneFile()
    {
        return $this->files()->first() ? asset('storage/'.$this->files()->first()->url) : asset('img/no-images.png');
    }

    public function getOneFileId()
    {
        return $this->files()->first() ? $this->files()->first()->id : '';
    }

    public function postSave($request, $identifier = 'id')
    {
        # code didieu
    }

    public static function saveData($request, $identifier = 'id')
    {
        $record = static::prepare($request, $identifier);
        $record->fill($request->all());
        $record->save();

        $record->postSave($request, $identifier);
        if($request->attachment)
        {
            if($request->attachment_exists)
            {
              $record->uploadWithoutDeleteAttachment($request->attachment, null, $request->attachment_exists);
            }else{
              $record->uploadWithoutDeleteAttachment($request->attachment);
            }
        }

        if($request->foto_users)
        {
            if($request->foto_users_exists)
            {
              $record->uploadWithDeleteFotoUsers($request->foto_users, null, $request->foto_users_exists);
            }else{
              $record->uploadWithDeleteFotoUsers($request->foto_users);
            }
        }

        // if($request->single_attachments){
        //     $record->deleteSingleAttachment($request->single_attachments);
        // }

        // if($request->single_input_attachment)
        // {
        //       $record->uploadSingleInputAttachment($request->single_input_attachment);
        // }

        // if($request->profile_picture)
        // {
        //       $record->uploadProfilePicture($request->profile_picture);
        // }

        // if($request->file)
        // {
        //     if($request->file_exists)
        //     {
        //       $record->multipleFilesUploadWithoutDelete($request->file, null, $request->file_exists);
        //     }else{
        //       $record->multipleFilesUploadWithoutDelete($request->file);
        //     }
        // }

        // if($request->embed)
        // {
        //     $record->addingEmbed($request->embed);
        // }

        return $record;
    }

    public function fillData($request)
    {
        $this->fill($request->all());
    }

    public static function getSorted()
    {
        return static::sort()->get();
    }

    public static function generateCode()
    {
        if (\Schema::hasColumn(with(new static )->getTable(), 'kode')) {
            $last = static::orderBy('kode', 'desc')->first();
            $kode = (!is_null($last) && $k = $last->kode) ? intval($last->kode) : 0;

            return str_pad($kode + 1, 5, "0", STR_PAD_LEFT);
        }

        return "";
    }

    public function uploadWithDeleteFotoUsers($foto_users, $taken = null, $exist = null)
    {
        if($exist != null)
        {
            if(count($exist) > 0){
              foreach ($exist as $key => $value) {
                $att = PictureUsers::find($key);
                if(file_exists(public_path('storage/'.$att->url)))
                {
                    unlink(public_path('storage/'.$att->url));
                }
                $att->delete();
              }
            }

            if(count($foto_users) > 0)
            {
                foreach($foto_users as $key => $result)
                {
                    if($result != null)
                    {

                      $data['filename'] = $result->getClientOriginalName();
                      $data['url'] = $result->store($this->filesMorphClass(), 'public');
                      $data['target_type'] = $this->filesMorphClass();
                      $data['target_id'] = $this->id;

                      if($taken != null)
                      {
                           $data['taken_at'] = $taken[$key];
                      }

                      $save = new PictureUsers;
                      $save->fill($data);
                      $save->save();
                    }
                }
            }
        }else{
          if(count($foto_users) > 0)
          {
              foreach($foto_users as $key => $result)
              {
                  if($result != null)
                  {

                    $data['filename'] = $result->getClientOriginalName();
                    $data['url'] = $result->store($this->filesMorphClass(), 'public');
                    $data['target_type'] = $this->filesMorphClass();
                    $data['target_id'] = $this->id;

                    if($taken != null)
                    {
                         $data['taken_at'] = $taken[$key];
                    }

                    $save = new PictureUsers;
                    $save->fill($data);
                    $save->save();
                  }
              }
          }
        }
    }


    public function uploadWithoutDeleteAttachment($attachments, $taken = null, $exist = null)
    {
        if($exist != null)
        {
            // if(count($exist) > 0){
            //   foreach ($exist as $key => $value) {
            //     $att = Attachments::find($key);
            //     if(file_exists(public_path('storage/'.$att->url)))
            //     {
            //         unlink(public_path('storage/'.$att->url));
            //     }
            //     $att->delete();
            //   }
            // }

            if(count($attachments) > 0)
            {
                foreach($attachments as $key => $result)
                {
                    if($result != null)
                    {

                      $data['filename'] = $result->getClientOriginalName();
                      $data['url'] = $result->store($this->filesMorphClass(), 'public');
                      $data['target_type'] = $this->filesMorphClass();
                      $data['target_id'] = $this->id;

                      if($taken != null)
                      {
                           $data['taken_at'] = $taken[$key];
                      }

                      $save = new Attachments;
                      $save->fill($data);
                      $save->save();
                    }
                }
            }
        }else{
          if(count($attachments) > 0)
          {
              foreach($attachments as $key => $result)
              {
                  if($result != null)
                  {

                    $data['filename'] = $result->getClientOriginalName();
                    $data['url'] = $result->store($this->filesMorphClass(), 'public');
                    $data['target_type'] = $this->filesMorphClass();
                    $data['target_id'] = $this->id;

                    if($taken != null)
                    {
                         $data['taken_at'] = $taken[$key];
                    }

                    $save = new Attachments;
                    $save->fill($data);
                    $save->save();
                  }
              }
          }
        }
    }

     

    public function uploadSingleInputAttachment($attachments, $taken = null)
    {
        if($attachments[0] != NULL)
        {
            if($this->attachment->count() > 0)
            {
                foreach($this->attachment as $fileExist)
                {
                  if(file_exists(public_path('storage/'.$fileExist->url)))
                  {
                      unlink(public_path('storage/'.$fileExist->url));
                  }
                  $fileExist->delete();
                }
            }

            foreach($attachments as $key => $attachment)
            {
                if($attachment != null)
                {

                  $data['filename'] = $attachment->getClientOriginalName();
                  $data['url'] = $attachment->store($this->filesMorphClass(), 'public');
                  $data['target_type'] = $this->filesMorphClass();
                  $data['target_id'] = $this->id;

                  if(count($taken) > 0)
                  {
                       $data['taken_at'] = $taken[$key];
                  }

                  $save = new Attachments;
                  $save->fill($data);
                  $save->save();
                }
            }
        }
    }

    public function uploadProfilePicture($file, $taken = null)
    {
        if($file)
        {
            if($this->files->count() > 0)
            {
                foreach($this->files as $fileExist)
                {
                  if(file_exists(public_path('storage/'.$fileExist->url)))
                  {
                      unlink(public_path('storage/'.$fileExist->url));
                  }
                  $fileExist->delete();
                }
            }
            if($file != null)
            {
              $data['filename'] = $file->getClientOriginalName();
              $data['url'] = $file->store($this->filesMorphClass(), 'public');
              $data['target_type'] = $this->filesMorphClass();
              $data['target_id'] = $this->id;

              if(count($taken) > 0)
              {
                   $data['taken_at'] = $taken[$key];
              }

              $save = new Files;
              $save->fill($data);
              $save->save();
            }
        }
    }

    public function uploadFilesWithDelete($files, $taken = null, $exist = null)
    {
        if($exist != null)
        {
          if($this->files->count() > 0)
          {
              foreach($this->files->whereNotIn('id', $exist) as $fileExist)
              {
                if(file_exists(public_path('storage/'.$fileExist->url)))
                {
                    unlink(public_path('storage/'.$fileExist->url));
                }
                $fileExist->delete();
              }
          }
        }else{
          if($this->files->count() > 0)
          {
              foreach($this->files as $fileExist)
              {
                if(file_exists(public_path('storage/'.$fileExist->url)))
                {
                    unlink(public_path('storage/'.$fileExist->url));
                }
                $fileExist->delete();
              }
          }
        }
        if($files)
        {
            foreach($files as $key => $upload)
            {
                if($upload != null)
                {
                  $data['filename'] = $upload->getClientOriginalName();
                  $data['url'] = $upload->store($this->filesMorphClass(), 'public');
                  $data['target_type'] = $this->filesMorphClass();
                  $data['target_id'] = $this->id;

                  if(count($taken) > 0)
                  {
                       $data['taken_at'] = $taken[$key];
                  }

                  $save = new Files;
                  $save->fill($data);
                  $save->save();
                }
            }
        }
    }

    public function multipleFilesUploadWithoutDelete($files, $taken = null, $exist = null)
    {

        if(count($files) > 0)
        {
            foreach($files as $key => $file)
            {
                if($file != null)
                {
                  $save = new Files;
                  $save->filename = $file->getClientOriginalName();
                  $save->url = $file->store($this->filesMorphClass(), 'public');
                  $save->target_type = $this->filesMorphClass();
                  $save->target_id = $this->id;
                  if(count($taken) > 0)
                  {
                    foreach ($taken as $Takenvalue) {
                       $save->taken_at = $Takenvalue;
                    }
                  }
                  $save->save();
                }
            }
        }
    }

    public function addingEmbed($embed)
    {
        if($embed)
        {
            foreach($embed as $key => $emb)
            {
                if($emb != null)
                {
                  if($this->embed->count() > 0)
                  {
                      foreach($this->embed as $embedExist)
                      {
                        $embedExist->delete();
                      }
                  }

                  $data['embed'] = $emb;
                  $data['target_type'] = $this->filesMorphClass();
                  $data['target_id'] = $this->id;

                  $save = new Embed;
                  $save->fill($data);
                  $save->save();
                }
            }
        }
    }

     public function uploadLoopAttachment($attachments, $taken = null)
    {

      if(isset($attachments))
      {
        if(isset($this->attachments))
        {
            $fileExist = $this->attachments;
              if(file_exists(public_path('storage/'.$fileExist->url)))
              {
                  unlink(public_path('storage/'.$fileExist->url));
              }
              $fileExist->delete();
        }

        $data['filename'] = $attachments->getClientOriginalName();
        $data['url'] = $attachments->store($this->filesMorphClass(), 'public');
        $data['target_type'] = $this->filesMorphClass();
        $data['target_id'] = $this->id;

        if(count($taken) > 0)
        {
             $data['taken_at'] = $taken[$key];
        }

        $save = new Attachments;
        $save->fill($data);
        $save->save();
      }
    }

    public function deleteAttachmen($id_attachment)
    {
        $attachment = Attachments::find($id_attachment);
        $attachment->delete();
    }

    public function downloadAttachments($id)
    {
        $check = Attachments::find($id);
        if(file_exists(public_path('storage/'.$check->url)))
        {
            return response()->download(public_path('storage/'.$check->url), $check->filename);
        }

        return $this->render('failed.file');
    }

     public function uploadWithDeleteAttachmentNew($attachments, $taken = null, $exist = null)
    {
        if($exist != null)
        {
            if($this->attachment != null){

              if(count($this->attachment) > 0)
              {
                  foreach($this->attachment->whereNotIn('id', $exist) as $fileExist)
                  {
                    if(file_exists(public_path('storage/'.$fileExist->url)))
                    {
                        unlink(public_path('storage/'.$fileExist->url));
                    }
                    $fileExist->delete();
                  }
              }
            }
        }else{
            if($this->attachment != null){

              if(count($this->attachment) > 0)
              {
                  foreach($this->attachment as $fileExist)
                  {
                    if(file_exists(public_path('storage/'.$fileExist->url)))
                    {
                        unlink(public_path('storage/'.$fileExist->url));
                    }
                    $fileExist->delete();
                  }
              }
            }
        }

        if($attachments)
        {
            foreach($attachments as $key => $attachment)
            {
                if($attachment != null)
                {

                  $data['filename'] = $attachment->getClientOriginalName();
                  $data['url'] = $attachment->store($this->filesMorphClass(), 'public');
                  $data['target_type'] = $this->filesMorphClass();
                  $data['target_id'] = $this->id;

                  if($taken != null)
                  {
                       $data['taken_at'] = $taken[$key];
                  }

                  $save = new Attachments;
                  $save->fill($data);
                  $save->save();
                }
            }
        }
    }

    public function deleteSingleAttachment($attachment){
        if(count($attachment) > 0){
          foreach ($attachment as $key => $value) {
            $att = Attachments::find($key);
            if(file_exists(public_path('storage/'.$att->url)))
            {
                unlink(public_path('storage/'.$att->url));
            }
            $att->delete();
          }
        }
    }
}
