<?php ?>
<div id="<?php echo $this->id ?>" class="form-group <?php echo $this->class; ?>">
    <?php
    if (!empty($this->label)) {
        ?>
        <label><?php echo $this->label; ?></label>
        <?php
    }
    ?>
    <textarea id="<?php echo $this->id ?>rte" class="form-control" name="<?php echo $this->name; ?>" <?php echo $this->getAttributes(array("class", "class")); ?> placeholder="<?php echo $this->placeholder; ?>"><?php echo $this->value; ?></textarea>
    <div class="msg require"><?php echo $this->msgRequire; ?></div>
    <div class="msg require-email"><?php echo $this->msgEmail; ?></div>
    <?php
    Hook::exec('pos_html_input', $this);
    ?>
</div>
<script>
    treepolar.callback.push(function () {
        CKEDITOR.replace('<?php echo $this->id ?>rte', {
            toolbar: [
                {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']},
                {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                {name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']},
                {name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField']},
                '/',
                {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
                {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
                {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
                {name: 'insert', items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']},
                '/',
                {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
                {name: 'colors', items: ['TextColor', 'BGColor']},
                {name: 'tools', items: ['Maximize', 'ShowBlocks']},
                {name: 'others', items: ['-']}
                ,
                {name: 'about', items: ['About']}
            ]
        });
    });
</script>