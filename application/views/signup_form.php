<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body{display:flex;justify-content:center;align-items:center;min-height:100vh;background:#f4f4f4;font-family:Arial, sans-serif}
      .signup-box{width:520px;background:#fff;padding:28px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.08)}
      .signup-box h2{text-align:center;margin-bottom:20px}
      .form-control{height:48px}
      .submit-btn{height:48px}
      .small-note{font-size:14px;color:#555;margin-top:10px;text-align:center}
    </style>
  </head>
  <body>

    <div class="signup-box">
      <h2>Create an account</h2>

      <form method="post" action="<?php echo base_url('Main/register'); ?>">

        <div class="row g-3">
          <div class="col-md-6">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="col-md-6">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>

          <div class="col-12">
            <input type="password" name="password" class="form-control" placeholder="Password (min 6 chars)" required minlength="6">
          </div>

          <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="First name" required>
          </div>
          <div class="col-md-4">
            <input type="text" name="middlename" class="form-control" placeholder="Middle name">
          </div>
          <div class="col-md-4">
            <input type="text" name="surname" class="form-control" placeholder="Surname" required>
          </div>

          <div class="col-md-6">
            <input type="date" name="dateofbirth" class="form-control" placeholder="Date of birth" required>
          </div>
          <div class="col-md-6">
            <select name="gender" class="form-control" required>
              <option value="">Select gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="col-12">
            <input type="text" name="companyposition" class="form-control" placeholder="Company / Position">
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-dark w-100 submit-btn">Create account</button>
          </div>
        </div>

        <div class="small-note">Already have an account? <a href="<?php echo base_url('Main'); ?>">Login</a></div>

      </form>
    </div>

    <!-- Flash messages via SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({icon:'error',title:'Oops...',text:'<?= addslashes($this->session->flashdata('error')); ?>'});
      <?php elseif ($this->session->flashdata('success')): ?>
        Swal.fire({icon:'success',title:'Success!',text:'<?= addslashes($this->session->flashdata('success')); ?>'});
      <?php endif; ?>
    </script>

  </body>
</html>
