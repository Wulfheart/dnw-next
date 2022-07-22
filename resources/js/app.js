import { DateTime } from "luxon";

import "./bootstrap";

import Alpine from "alpinejs";
import tippy from "tippy.js";
// import "tippy.js/dist/tippy.css";
import collapse from '@alpinejs/collapse'

// Why doesn't this have to be registered?
import Toolkit from "@alpine-collective/toolkit";

Alpine.plugin(collapse)

window.Alpine = Alpine;

window.Alpine.start();

tippy("[data-tippy-content]");

window.relativeTimeLeft = function (timestamp) {
    // TODO: Remove the in prefix
    return DateTime.fromISO(timestamp).setLocale("de").toRelative({
        style: "narrow",
        padding: 100,
    });
};
