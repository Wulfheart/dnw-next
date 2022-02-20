import { DateTime } from "luxon";

require("./bootstrap");

import Alpine from "alpinejs";

// Why doesn't this have to be registered?
import Toolkit from "@alpine-collective/toolkit";

window.Alpine = Alpine;

Alpine.start();


window.relativeTimeLeft = function (timestamp){
    // TODO: Remove the in prefix
    return DateTime.fromISO(timestamp).setLocale('de').toRelative({
        style: 'narrow',
        padding: 100
    });
}
