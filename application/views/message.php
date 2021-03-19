<?php if($this->session->flashdata('success')){ ?>
<script>
Swal.fire(
  "Berhasil!",
  "<?= $this->session->flashdata('success'); ?>",
  "success"
);
</script>
<?php }

if($this->session->flashdata('flash_error')){ ?>
<script>
Swal.fire(
  icon: 'error',
  title: 'Oops...',
  text: '<?= $this->session->flashdata('flash_error'); ?>',
);
</script>
<?php } ?>
<!-- <?php if($this->session->has_userdata('error')){ ?>
<div class="alert alert-error alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
<i class="icon fa fa-ban"></i><?=$this->session->flashdata('error');?>
</div>
<?php } ?> -->