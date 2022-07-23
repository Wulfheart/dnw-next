import "./bootstrap";
import "./game";

import Alpine from "alpinejs";
import tippy from "tippy.js";
// import "tippy.js/dist/tippy.css";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);

window.Alpine = Alpine;

window.Alpine.start();

tippy("[data-tippy-content]");

