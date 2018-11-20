@extends("admin.layout.base")

@section("body")
@include("admin.layout.nav")

<div class="main-section">
  <nav class="{{ config('sidebar-menu')['colors']['primary-name'] }}">
    <div class="nav-wrapper flex space-between align-center">
      @section("navbar")

      @show
    </div>
  </nav>
  @section("content")

  @show
</div>
<div id="confirmation" class="modal">
  <div class="modal-content">
    <h4>Are you sure you want to delete ?</h4>
    <p>This action can't be undone!</p>
  </div>
  <div class="modal-footer">
    <button class="modal-close waves-effect waves-dark btn-flat" id="confirmation-reject">No</a>
    <button class="modal-close waves-effect waves-dark btn-flat" id="confirmation-accept">Yes</a>
  </div>
</div>


@stop