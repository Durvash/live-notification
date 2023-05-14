<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<nav class="navbar navbar-expand-sm bg-light">

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" id="logout" href="javascript:">Logout</a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li> -->
  </ul>

</nav>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).off('click', '#logout');
  $(document).on('click', '#logout', function(event) {
    event.preventDefault();
    $.ajax({
      url: '<?php echo base_url("/logout") ?>',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          window.location.href = '<?php echo base_url() ?>';
        } else {
          alert('Something went wrong. Please try again.');
        }
      },
      error: function() {
        alert('An error occurred. Please try again later.');
      }
    });
  });
</script>