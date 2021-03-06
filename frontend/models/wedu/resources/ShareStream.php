<?php
namespace frontend\models\wedu\resources;
use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\campus\models\ShareStream as BaseShareStream;
use frontend\models\wedu\resources\FileStorageItem;
use frontend\models\wedu\resources\ShareToFile;

class ShareStream extends BaseShareStream
{
    private  $_storage_ids = [];
    private  $_error       = [];
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    public function fields(){
        return ArrayHelper::merge(
                parent::fields(),
                [
                    'imageUrl'=>function(){
                        $date = [];
                      foreach ($this->shareToFile as $key => $value) {
                            if(isset($value->fileStorageItem)){
                                $data[] = $value->fileStorageItem->url.$value->fileStorageItem->file_name;
                            }
                      }
                      return $data;
                    },
                    'user_label'=>function(){
                        return $this->getUserName($this->user_id);
                    },
                    'created_at'=>function(){
                        return date('Y-m-d h:i:s',$this->created_at);
                    },
                    'user_avatar'=>function(){
                        return $this->getUserAvatar($this->user_id);
                    }
                ]
            );
    }
    public function batch_create($data){
        if(isset($data['FileStorageItem']) && count($data['FileStorageItem']) > 9 ){
            return $this->addErrors('_example','图片不能大于9张');
        }

        if(isset($data['FileStorageItem'])){
            $transaction = $this->db->beginTransaction();
            //var_dump();exit;
            $this->load($data['ShareStream'],'');
            if($this->save() == false){
                $transaction->rollBack();
                return $this;
            }
            $storage = $this->addFileStorageItem($data['FileStorageItem']);
            if(isset($storage) && $storage->hasErrors()){
                $transaction->rollBack();
                return $storage;
            }
            $share_to_file = $this->addShareToFile($this->share_stream_id);
            if(isset($share_to_file) && $share_to_file->hasErrors()){
                $transaction->rollBack();
                return $share_to_file;
            }

            $transaction->commit();
            return $this;
        }else{
            $this->load($data['ShareStream'],'');
            $this->save();
            return $this;
        }

    }

    public function addFileStorageItem($data){
        foreach ($data as $key => $value) {
           $model = new FileStorageItem();
           $value['user_id']   = Yii::$app->user->identity->id;
           $value['url']       = Yii::$app->params['qiniu']['wakooedu']['domain'].'/';
           $value['status']    = 1;
           $value['upload_ip'] = Yii::$app->request->getUserIP();
           $model->load($value,'');
           if(!$model->save()){
               return $model;
           }
           $this->_storage_ids[$key] = $model->file_storage_item_id;
        }
    }

    public function addShareToFile($share_stream_id){
        foreach ($this->_storage_ids as $key => $value) {
            $model = new ShareToFile();
            $model->file_storage_item_id = $value;
            $model->share_stream_id        = $share_stream_id;
            $model->status               = 1;
            if(!$model->save()){
                return $model;
            }
        }
    }
}

?>