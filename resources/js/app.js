import "./bootstrap";
import "./game";

import Alpine from "alpinejs-tmp-alex";

import tippy from "tippy.js";
// import "tippy.js/dist/tippy.css";
import collapse from "@alpinejs/collapse";

import.meta.glob([
  '../fonts/**',
]);

Alpine.plugin(collapse);

window.Alpine = Alpine;

window.Alpine.start();

tippy("[data-tippy-content]");

document.addEventListener("alpine:init", () => {
  console.log("alpine:init");
});
