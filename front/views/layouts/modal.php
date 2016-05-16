<?php $this->beginContent('@front/views/layouts/auto-modal.php'); ?>

<div class="modal_layout">
    <div class="modal-dialog">
        <div id="modal-content" class="modal-content">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close model-close-btn" onclick="parent.$('.modal').modal('hide')">
                <i class="icon-remove"></i>
            </button>
            <?= $content; ?>
        </div>
    </div>
</div>

<?php $this->endContent(); ?>