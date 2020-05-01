<?php
class Form
{

    /**
     * @param $for
     * @param $title
     * @param $class
     */
    public function label($for, $title, $class): void
    {
        echo '<label for=' . $for . ' class=' . $class . '>' . $title . '</label>';
    }

    public function input($type, $name, $id, $class, $placeholder = NULL, $value = ''): void
    {
        echo '<input type=' . $type . ' name=' . $name . ' id=' . $id . ' class=' . $class . ' placeholder=' . $placeholder . ' value=' . $value . '>';
        //echo '<input type='.$type.' placeholder='.$placeholder.'>';
    }

    /**
     * @param $name
     * @param $class
     * @param $id
     * @param $placeholder
     * @param string $rows
     * @param string $text
     */
    public function textarea($name, $class, $id, $placeholder, $rows = '5', $text = ''): void
    {
        echo '<textarea name="' . $name . '" class="' . $class . '" id="' . $id . '" placeholder="' . $placeholder . '" rows="' . $rows . '">' . $text . '</textarea>';
    }

    /**
     * @param $select_name
     * @param $select_class
     * @param $option_text
     * @param $option_value
     */
    public function select($select_name, $select_class, $option_text, $option_value): void
    {
        echo '<select name=' . $select_name . ' class=' . $select_class . '>' . '<option value=' . $option_value . '>' . $option_text . '</option>' . '</select>';
    }

    /**
     * @param $type
     * @param $name
     * @param $text
     * @param $class
     */
    public function btn($type, $name, $text, $class): void
    {
        echo '<button type=' . $type . ' name=' . $name . ' class=' . $class . '>' . $text . '</button>';
    }

    public function get_error(?string $error = NULL)
    {
        if ($error != NULL) {
            echo '<div class="text-center alert alert-danger">' . $error . '</div>';
        }
    }
    public function get_success(?string $success = NULL)
    {
        if ($success != NULL) {
            echo '<div class="text-center alert alert-success">' . $success . '</div>';
        }
    }
}