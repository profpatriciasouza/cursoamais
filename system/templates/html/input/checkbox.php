<div id="<?php echo $this->id ?>" class="form-group">
    <div class="col-lg-12">
        <div class="checkbox  <?php echo $this->class; ?>">
            <label>
                <input type="checkbox" name="<?php echo $this->name; ?>"  <?php echo $this->getAttributes(); ?>> <?php echo $this->label; ?>
            </label>
        </div>
    </div>
</div>