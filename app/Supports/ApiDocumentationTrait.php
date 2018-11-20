<?php

namespace App\Supports;

trait ApiDocumentationTrait {
  private function postParameters($request) {
    $return = [];
    if (method_exists($request, "requestAttributes")) {
      foreach($request -> requestAttributes() as $input) {
        $data["name"] = $input;
        $data["type"] = "POST";
        if(method_exists($request ,"rules") && array_key_exists($input, $request->rules())) {
          $rule = $request -> rules()[$input];
          if (is_array($request -> rules()[$input])) {
            $rule = implode("|", $rule);
          }
          $data["validation"] = str_replace(["|","nullable"], ["[#]","optional"], $rule);
          if(str_contains($rule , "confirmed")){
            $new_parameter["name"]       = $input."_confirmation";
            $new_parameter["type"]       = "POST";
            $new_parameter["validation"] = "required[#]same as ".$input;
          }
        }else{
          $data["validation"] = "optional";
        }
        $return[] = $data;
        if(isset($new_parameter)){
          $return[] = $new_parameter;
          unset($new_parameter);
        }
      }
    }
    return $return;
  }

  private function getParameters(...$parameters) {
    $return = [];
    foreach ($parameters as $value) {
      $data["name"] = $value;
      $data["type"] = "GET";
      if(!ends_with($value,"?")) {
        $data["validation"] = "required";
      } else {
        $data["name"] = rtrim($data["name"], "?");
        $data["validation"] = "optional";
      }
      $return[] = $data;
    }
    return $return;
  }

  private function links() {
    return [
      "links" => [
        "first" => url("/")."/api/workshop/normal-requests/500?page=1",
        "last"  => url("/")."/api/workshop/normal-requests/500?page=9",
        "prev"  => null,
        "next"  => url("/")."/api/workshop/normal-requests/500?page=2"
      ],
      "meta" => [
        "current_page" => 1,
        "from"         => 1,
        "last_page"    => 9,
        "path"         => url("/")."/api/workshop/normal-requests/500",
        "per_page"     => 10,
        "to"           => 10,
        "total"        => 100
      ]
    ];
  }
}