<div class="f">
    <label>&nbsp;</label>
    <div class="submit">
        <?=$this->preHTML;?>
        <input  type="button" class="btn <?=$this->classBTN?>" 
               value="<?=$this->value?>" 
               id="<?=$this->id?>"
                <?=$this->onClick!="" ? "onclick='".$this->onClick."'" : "" ?> />
    </div>
</div>