<?php if($paginator->hasPages()): ?>
<div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
    <ul class="pagination">
        <?php if($paginator->onFirstPage()): ?>
        <li class="paginate_button page-item previous disabled" id="example_previous"><button aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link"><i class="ni ni-bold-left"></i></a></li>
        <?php else: ?>
        <li class="paginate_button page-item previous" id="example_previous"><button aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link" wire:click='previousPage'><i class="ni ni-bold-left"></i></a></li>
        <?php endif; ?>

        <?php if($paginator->hasMorePages()): ?>
        <li class="paginate_button page-item next" id="example_next"><button aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link" wire:click='nextPage'></a></li>
        <?php else: ?>
        <li class="paginate_button page-item next disabled" id="example_next"><button aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link"><i class="ni ni-bold-right"></i></a></li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?>