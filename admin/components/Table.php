<?php
class Table
{
    private $tbl, $header, $content, $id, $styles, $attributes, $columns, $form, 
    $tblTitle, $hasActions;
    
    public function __construct($tbl)
    {
        $this->tbl = $tbl;
    }

    public function build_header()
    {
        $header = "";
        $keys = array_keys($this->tbl[0]);
        foreach ($keys as $th) {
            $newTh = str_replace("_", " ", $th);
            $header .= "<th>$newTh</th>";
        }
        $header .= isset($this->hasActions) && $this->hasActions ? "<th>Actions</th>" : "";
        $this->setHeader($header);
    }

    public function build_rows()
    {
        $rows = "";
        foreach ($this->tbl as $key => $row) {
            if (gettype($row) != "array") break;
            $rows .= "<tr>";
            $targetId = 0;
            foreach ($row as $subKey => $subRow) {
                $rows .= "<td>$subRow</td>";
                if($subKey == "id") $targetId = $subRow;
            }
            $rows .= isset($this->hasActions) && $this->hasActions ? <<<ACT
            <td class="action-column">
                <!-- View Button -->
                <button class="action-button view-button" method="view" target-modal="view_reservation_modal" target-id="{$targetId}" 
                    target-form="{$this->getForm()}ViewForm" data-function="fetch_user_rooms">
                    <i class="fas fa-eye"></i> View
                </button>
                
                <!-- Delete Button -->
                <button class="action-button delete-button" method="delete" target-id="{$targetId}"
                onclick="delete_row({$targetId},'{$this->tblTitle}')">
                    <i class="fas fa-trash"></i> Delete
                </button>
                
                <!-- Update Button -->
                <button class="action-button update-button" method="update" target-modal="update_reservation_modal" target-id="{$targetId}"
                    target-form="{$this->getForm()}UpdateForm" data-function="fetch_user_rooms">
                    <i class="fas fa-edit"></i> Update
                </button>
            </td>
            ACT : "";
            $rows .= "</tr>";
        }
        $this->setContent($rows);
    }

    function build_table()
    {
        $this->build_header();
        $this->build_rows();
        return <<<TBL
            <table class="tbl">
                <thead>
                    {$this->getHeader()}
                </thead>
                <tbody>
                    {$this->getContent()}
                </tbody>
            </table>
            TBL;
    }

    /**
     * Get the value of tbl
     */
    public function getTbl()
    {
        return $this->tbl;
    }

    /**
     * Set the value of tbl
     *
     * @return  self
     */
    public function setTbl($tbl)
    {
        $this->tbl = $tbl;

        return $this;
    }

    /**
     * Get the value of header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set the value of header
     *
     * @return  self
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
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
     * Get the value of styles
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Set the value of styles
     *
     * @return  self
     */
    public function setStyles($styles)
    {
        $this->styles = $styles;

        return $this;
    }

    /**
     * Get the value of attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set the value of attributes
     *
     * @return  self
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

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
     * Get the value of form
     */ 
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set the value of form
     *
     * @return  self
     */ 
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get the value of tblTitle
     */ 
    public function getTblTitle()
    {
        return $this->tblTitle;
    }

    /**
     * Set the value of tblTitle
     *
     * @return  self
     */ 
    public function setTblTitle($tblTitle)
    {
        $this->tblTitle = $tblTitle;

        return $this;
    }

    /**
     * Get the value of hasActions
     */ 
    public function getHasActions()
    {
        return $this->hasActions;
    }

    /**
     * Set the value of hasActions
     *
     * @return  self
     */ 
    public function setHasActions($hasActions)
    {
        $this->hasActions = $hasActions;

        return $this;
    }
}
