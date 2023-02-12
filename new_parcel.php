<?php if (!isset($conn)) {
  include 'db_connect.php';
} ?>

<style>
  textarea {
    resize: none;
  }
</style>
<div class="col-lg-12">
  <div class="card">
    <h3 class="card-header">Parcel Request Form</h3>
    <div class="card-body">
      <div class="alert d-none" id="alert_box" role="alert"></div>
      <form action="" id="manage-parcel">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div id="msg" class=""></div>
        <div class="row">
          <div class="col-md-6">
            <b>Sender Information</b>
            <div class="form-row">
              <div class="form-group col">
                <label for="" class="control-label">Name</label>
                <input type="text" name="sender_name" id="" class="form-control form-control" value="<?php echo isset($sender_name) ? $sender_name : '' ?>" required>
              </div>
              <div class="form-group col">
                <label for="" class="control-label">Address</label>
                <input type="text" name="sender_address" id="" class="form-control form-control" value="<?php echo isset($sender_address) ? $sender_address : '' ?>" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="" class="control-label">Contact #</label>
                <input type="text" name="sender_contact" id="" class="form-control form-control" value="<?php echo isset($sender_contact) ? $sender_contact : '' ?>" required>
              </div>
              <div class="form-group col">
                <label for="" class="control-label">Email</label>
                <input type="email" name="sender_email" id="" class="form-control form-control" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" readonly>
              </div>
            </div>


          </div>
          <div class="col-md-6">
            <b>Recipient Information</b>
            <div class="form-row">
              <div class="form-group col">
                <label for="" class="control-label">Name</label>
                <input type="text" name="recipient_name" id="" class="form-control form-control" value="<?php echo isset($recipient_name) ? $recipient_name : '' ?>" required>
              </div>
              <div class="form-group col">
                <label for="" class="control-label">Address</label>
                <input type="text" name="recipient_address" id="" class="form-control form-control" value="<?php echo isset($recipient_address) ? $recipient_address : '' ?>" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="" class="control-label">Contact #</label>
                <input type="text" name="recipient_contact" id="" class="form-control form-control" value="<?php echo isset($recipient_contact) ? $recipient_contact : '' ?>" required>
              </div>
              <div class="form-group col ">
                <label for="" class="control-label">Email</label>
                <input type="email" name="recipient_email" id="" class="form-control form-control" value="<?php echo isset($recipient_email) ? $recipient_email : '' ?>" required>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row align-items-center">
          <div class="col-2">
            <div class="form-group">
              <input type="checkbox" name="type" id="dtype" <?php echo isset($type) && $type == 1 ? 'checked' : '' ?> value="1">
              <label for="dtype">Deliver</label>
            </div>
          </div>
          <div class="col-10" id="" <?php echo isset($type) && $type == 1 ? 'style="display: none"' : '' ?>>
            <?php if (isset($_SESSION['email']) >= 0) : ?>
              <div class="form-row">
                <div class="form-group col" id="fbi-field">
                  <label for="" class="control-label">Branch Processed</label>
                  <select name="from_branch_id" id="from_branch_id" class="form-control select2" required="">
                    <option value=""> </option>
                    <?php
                    $branches = $conn->query("SELECT *,concat(address,', ',city,', ',contact,', ',zip_code,', ',country) as addresss FROM branches");
                    while ($row = $branches->fetch_assoc()) :
                    ?>
                      <option value="<?php echo $row['id'] ?>" <?php echo isset($from_branch_id) && $from_branch_id == $row['id'] ? "selected" : '' ?>><?php echo (ucwords($row['addresss'])) ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
              <?php else : ?>
                <input type="hidden" name="from_branch_id" value="<?php echo $_SESSION['login_branch_id'] ?>">
              <?php endif; ?>
              <div class="form-group col" id="tbi-field">
                <label for="" class="control-label">Pickup Branch</label>
                <select name="to_branch_id" id="to_branch_id" class="form-control select2">
                  <option value=""></option>
                  <?php
                  $branches = $conn->query("SELECT *,concat(address,', ',city,', ',contact,', ',zip_code,', ',country) as addresss FROM branches");
                  while ($row = $branches->fetch_assoc()) :
                  ?>
                    <option value="<?php echo $row['id'] ?>" <?php echo isset($to_branch_id) && $to_branch_id == $row['id'] ? "selected" : '' ?>><?php echo (ucwords($row['addresss'])) ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
              </div>

          </div>
        </div>

        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="form-group">
              <label for="delivery_type" class="control-label">Delivery Type <span class="badge badge-pill badge-danger">+50 tk for Express delivery</span></label>

              <select name="delivery_type" id="delivery_type" class="form-control " required="">
                <option value=""></option>
                <option value="1">Regular </option>
                <option value="2">Express</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group" id="dbi-field">
              <label for="" class="control-label">Parcel Type <span class="badge badge-pill badge-danger">+50 tk for Confidential</span></label>
              <select name="parcel_type" id="parcel_type" class="form-control " required="">
                <option value=""></option>
                <option value="normal" <?php echo isset($parcel_type) && $parcel_type == 'normal' ? "selected" : '' ?>>Normal</option>
                <option value="confidential" <?php echo isset($parcel_type) && $parcel_type == 'confidential' ? "selected" : '' ?>>Confidential</option>
              </select>
            </div>
          </div>
        </div>
        <hr>
        <b>Parcel Information</b>
        <div class="table-responsive">
          <table class="table table-bordered" id="parcel-items">
            <thead>
              <tr>
                <th scope="col">Weight</th>
                <th scope="col">Height</th>
                <th scope="col">Length</th>
                <th scope="col">Width</th>
                <!-- <th scope="col">Price</th> -->
                <?php if (!isset($id)) : ?>
                  <th scope="col"></th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row"><input type="number" class="form-control" name='weight[]' value="<?php echo isset($weight) ? $weight : '' ?>" required></td>
                <td><input type="number" class="form-control" name='height[]' value="<?php echo isset($height) ? $height : '' ?>" required></td>
                <td><input type="number" class="form-control" name='length[]' value="<?php echo isset($length) ? $length : '' ?>" required></td>
                <td><input type="number" class="form-control" name='width[]' value="<?php echo isset($width) ? $width : '' ?>" required></td>
                <td class="d-none"><input type="hidden" class="text-right number" name='price[]' value=0></td>
                <?php if (!isset($id)) : ?>
                  <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i></button></td>
                <?php endif; ?>
              </tr>
            </tbody>
          </table>
        </div>

      </form>
    </div>
    <div class="card-footer">
      <div class="d-flex w-100 justify-content-center align-items-center">
        <button class="btn btn-success mx-2" form="manage-parcel">Submit</button>
        <a class="btn btn-danger mx-2" href="index.php#service">Cancel</a>
      </div>
    </div>
  </div>
</div>
<div id="ptr_clone" class="d-none table-responsive">
  <table>
    <tr>
      <td><input type="text" name='weight[]' required></td>
      <td><input type="text" name='height[]' required></td>
      <td><input type="text" name='length[]' required></td>
      <td><input type="text" name='width[]' required></td>
      <td class="d-none"><input type="hidden" class="text-right number" name='price[]' required></td>
      <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i></button></td>
    </tr>
  </table>
</div>
<script>
  $('#dtype').change(function() {
    if ($(this).prop('checked') == true) {
      $('#tbi-field').hide()
    } else {
      $('#tbi-field').show()
    }
  })
  $('[name="price[]"]').keyup(function() {
    calc()
  })
  $('#new_parcel').click(function() {
    var tr = $('#ptr_clone tr').clone()
    $('#parcel-items tbody').append(tr)
    $('[name="price[]"]').keyup(function() {
      calc()
    })
    $('.number').on('input keyup keypress', function() {
      var val = $(this).val()
      val = val.replace(/[^0-9]/, '');
      val = val.replace(/,/g, '');
      val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
      $(this).val(val)
    })

  })
  $('#manage-parcel').submit(function(e) {
    e.preventDefault()
    start_load()
    if ($('#parcel-items tbody tr').length <= 0) {
      document.getElementById("alert_box").innerHTML = "Please add atleast 1 parcel information.";
      document.getElementById("alert_box").classList.remove("d-none");
      document.getElementById("alert_box").classList.remove("alert-danger");
      end_load()
      return false;
    }
    $.ajax({
      url: 'user_ajax.php?action=save_parcel',
      data: new FormData($(this)[0]),
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      type: 'POST',
      success: function(resp) {

        if (resp == 1) {
          document.getElementById("alert_box").innerHTML = "Submitted Successfuly !";
          document.getElementById("alert_box").classList.remove("d-none");
          document.getElementById("alert_box").classList.add("alert-success");
          setTimeout(function() {
            location.href = 'profile.php';
          }, 1500)

        } else {
          document.getElementById("alert_box").innerHTML = "Submit Failed !";
          document.getElementById("alert_box").classList.remove("d-none");
          document.getElementById("alert_box").classList.remove("alert-danger");
        }
      }
    })
  })

  function displayImgCover(input, _this) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#cover').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  function calc() {

    var total = 0;
    $('#parcel-items [name="price[]"]').each(function() {
      var p = $(this).val();
      p = p.replace(/,/g, '')
      p = p > 0 ? p : 0;
      total = parseFloat(p) + parseFloat(total)
    })
    if ($('#tAmount').length > 0)
      $('#tAmount').text(parseFloat(total).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
      }))
  }
</script>