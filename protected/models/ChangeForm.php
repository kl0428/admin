<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-27
 * Time: 上午9:54
 */
class ChangeForm extends CFormModel
{
    public $name;
    public $old_pwd;
    public $new_pwd;
    public $sure_pwd;

    //规则
    public function rules()
    {
        return array(
            array('old_pwd,new_pwd,sure_pwd','required'),
            array('new_pwd','match','pattern'=>'/^[a-zA-Z0-9\-_]+$/'),
            array('sure_pwd','compare','compareAttribute'=>'new_pwd','message'=>'两次密码输入不一致'),
            array('name','safe')
        );
    }

    public function AttributeLabels()
    {
        return array(
            'name'      => '被考核人',
            'old_pwd'   => '旧密码',
            'new_pwd'   => '新密码',
            'sure_pwd'  => '确认密码',
        );
    }

    public function checkPwd($id,$pwd)
    {
        $model = Managers::model()->findByPk($id);
        $entry_pwd = md5($model->name.md5($pwd));
        if($entry_pwd == $model->password){
            return true;
        }else{
            $this->addError('old_pwd','密码错误,请重新再试!');
            return false;
        }
    }

}