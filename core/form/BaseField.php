<?php
namespace app\core\form;

abstract class BaseField{
    public $model;
    public $attribute;
    public function __construct($model, $attribute){
        $this->model = $model;
        $this->attribute = $attribute;
    }
    abstract public function renderInput() :string;
    public function __toString(){
        return sprintf('<div class="form-group">
          <label>%s</label>
          %s
          </div><div class="invalid-feedback">%s</div>',
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->renderInput(),
            $this->model->getFirstError($this->attribute));
    }
}