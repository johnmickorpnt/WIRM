<?php
class Form
{
    private $columns = array();
    private $model, $id, $method, $action;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function build_rows()
    {
        $rows = "";
        foreach ($this->getColumns() as $col) {
            $column = $col["column"];
            $label = str_replace("_", " ", $column);
            if ($col["type"] == "input") {
                $rows .= <<<ROW
                    <div class="input-wrapper">
                        <input type="text" class="modern-input" id="{$column}" name="{$column}">
                        <label class="input-label" for="{$column}">{$label}</label>
                    </div>
                ROW;
            }
            else if ($col["type"] == "select") {
                $rows .= <<<ROW
                <div class="select-wrapper">
                    <select class="modern-select">
                        <option value="" selected disabled>Select an option</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                    </select>
                    <span class="select-arrow"></span>
                </div>
                ROW;
            }
        }
        return $rows;
    }

    public function build_form()
    {
        $content = <<<FORM
        haha
        <form id="{$this->getId()}">
            {$this->build_rows()}
        </form>
        FORM;
        return $content;
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return  self
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of columns
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the value of columns
     *
     * @return  self
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Append the value of columns
     *
     * @return  self
     */
    public function addColumn($type, $column)
    {
        array_push($this->columns, ["type" => $type, "column" => $column]);

        return $this;
    }

    /**
     * Get the value of action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the value of model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }
}
