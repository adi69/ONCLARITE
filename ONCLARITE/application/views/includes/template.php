<?php $this->load->view("includes/header") ?>
<?php $this->load->view("includes/menu") ?>
<center><img src="<?php echo base_url('images/logo.png'); ?>" height = "100px" /></center>
<?php $this->load->view($main_content) ?>
<hr>
<?php $this->load->view("includes/footer") ?>