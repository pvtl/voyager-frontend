<?php
$selected_value = (isset($dataTypeContent->{$row->field}) && !is_null(old($row->field, $dataTypeContent->{$row->field}))) ? old($row->field, $dataTypeContent->{$row->field}) : old($row->field);

$layouts = \Pvtl\VoyagerFrontend\Helpers\Layouts::getLayouts('voyager-frontend');
?>
<select class="form-control select2" name="{{ $row->field }}">
    @foreach($layouts as $layout)
        <option value="{{ $layout }}"
                @if ($selected_value === $layout)
                selected="selected"
                @endif
        >{{ $layout }}</option>
    @endforeach
</select>
