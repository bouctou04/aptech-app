<?php
class Form
{

    /**
     * @param $for
     * @param $title
     * @param $class
     */
    public function label(?string $for = "field", ?string $title = "Input field", ?string $class = NULL): void
    {
        echo '<label for=' . $for . ' class=' . $class . '>' . $title . '</label>';
    }

    public function input(?string $type = "text", ?string $name = "field", ?string $id = "field", ?string $class = NULL, ?string $data_length = NULL, ?string $placeholder = NULL, ?string $value = NULL): void
    {
        if($placeholder) {
            echo '<input type=' . $type . ' name=' . $name . ' id=' . $id . ' class=' . $class . ' placeholder=' . $placeholder . ' value=' . $value . '>';
        } elseif ($data_length) {
            echo '<input type=' . $type . ' name=' . $name . ' id=' . $id . ' class=' . $class . ' data-length=' . $data_length . ' value=' . $value . '>';
        } else {
            echo '<input type=' . $type . ' name=' . $name . ' id=' . $id . ' class=' . $class . ' value=' . $value . '>';
        }
    }

    /**
     * @param $name
     * @param $class
     * @param $id
     * @param $placeholder
     * @param string $rows
     * @param string $text
     */
    public function textarea(?string $name = "field", ?string $id, ?string $class = "materialize-textarea", ?string $data_length = NULL, ?string $placeholder = NULL, ?string $rows = NULL, ?string $text = NULL): void
    {
        if($placeholder) {
            echo '<textarea name="' . $name . '" class="' . $class . '" id="' . $id . '" placeholder="' . $placeholder . '" rows="' . $rows . '">' . $text . '</textarea>';
        } elseif ($data_length) {
            echo '<textarea name="' . $name . '" class="' . $class . '" id="' . $id . '" data-length="' . $data_length . '" rows="' . $rows . '">' . $text . '</textarea>';
        } else {
            echo '<textarea name="' . $name . '" class="' . $class . '" id="' . $id . '" rows="' . $rows . '">' . $text . '</textarea>';

        }
    }

    /**
     * @param $select_name
     * @param $select_class
     * @param $option_text
     * @param $option_value
     */
    public function select($name, $class, $option_text, $option_value): void
    {
        echo '<select name=' . $name . ' class=' . $class . '>' . '<option value=' . $option_value . '>' . $option_text . '</option>' . '</select>';
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
