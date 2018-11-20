
<div class="row">
	<div class="col-xs-12">
		@include("admin.components.select", [
		  "label" => "Branch",
		  "name" => "branch_id",
		  "options" => $branches,
		  "old"  => isset($teacher) ? $teacher -> branch_id : ""
		])
	</div>
	<div class="col-xs-12">
		@include("admin.components.input", [
		  "name" => "name",
		  "old"  => isset($teacher) ? $teacher -> name : ""
		])
	</div>
	<div class="col-xs-12">
		@include("admin.components.input", [
		  "name" => "email",
		  "old"  => isset($teacher) ? $teacher -> email : ""
		])
	</div>
	<div class="col-xs-12">
		@include("admin.components.input", [
			"name"      => "password",
			"type"      => "password",
			"dontFlash" => true
		])
	</div>
	<div class="col-xs-12">
		@include("admin.components.input", [
			"label"     => "Password confirmation",
			"name"      => "password_confirmation",
			"type"      => "password",
			"dontFlash" => true
		])
	</div>
	<div class="col-xs-12">
		@include("admin.components.input", [
			"name" => "phone",
			"old"  => isset($teacher) ? $teacher -> phone : ""
		])
	</div>
	<div class="col-xs-12">
		@include("admin.components.textarea", [
			"name" => "description",
			"old"  => isset($teacher) ? $teacher -> description : ""
		])
	</div>
	<div class="col-xs-12">
		@include("admin.components.textarea", [
			"name" => "address",
			"old"  => isset($teacher) ? $teacher -> address : ""
		])
	</div>
	<div class="col-md-6 col-xs-12">
		@include("admin.components.input", [
			"label" => "Birth Date",
			"name" => "birth_date",
			"type" => "date",
			"old"  => isset($teacher) ? $teacher -> birth_date : ""
		])
	</div>
	<div class="col-md-6 col-xs-12">
		@include("admin.components.select", [
		  "label" => "Gender",
		  "name" => "gender",
		  "options" => [
				"male"   => "Male",
				"female" => "Female",
				"other"  => "Other"
		  ],
		  "old"  => isset($teacher) ? $teacher -> gender : ""
		])
	</div>
	<div class="col-xs-12">
		@include("admin.components.input", [
			"name" => "nationality",
			"old"  => isset($teacher) ? $teacher -> nationality : ""
		])
	</div>
</div>