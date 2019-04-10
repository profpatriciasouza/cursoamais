<div class="row">
    <div id="<?php echo $this->id ?>" class="form-group <?php echo $this->class; ?>" <?php if ($this->isRequired) echo "obrigatorio='sim'"; ?>>

        <?php
        if (!empty($this->label)) {
            ?>
            <label class='col-xs-12'><?php echo $this->label; ?></label>
            <?php
        }
        ?>
        <?php
        $field = $this->name;
        $foto = $this->value;
        if ($foto != "") {
            ?>
            <div class="col-xs-3">
                <input type="hidden" name="i<?php echo $field; ?>" value="<?php echo $foto ?>" />
                <?php echo $foto; ?><br />
                <a target='_blank' href='<?php echo System_CONFIG::get('upload_url').$foto; ?>' class="btn btn-primary">ver</a>
                <button type="button" class="btn btn-danger btn-excluir-imagem">excluir</button>
            </div>
            <?php
        }
        ?>
        <div class="col-xs-7">
            <input type="file" name="<?php echo $field; ?>" class="form-control" />
        </div>
    </div>
</div>