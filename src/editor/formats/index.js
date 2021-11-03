/**
 * Internal dependencies
 */

import { justify } from "./justify";
import { underline } from "./underline";

/**
 * WordPress dependencies
 */

import { registerFormatType, unregisterFormatType } from "@wordpress/rich-text";
import { select } from "@wordpress/data";
import domReady from "@wordpress/dom-ready";

const stiellerRegisterFormats = () => {
    [justify, underline].forEach(({ name, ...settings }) => {
        // unregister core underline if it exists...
        if ("stieller/underline" === name) {
            const underlineFormat = select("core/rich-text").getFormatType("core/underline");
            if (underlineFormat) {
                unregisterFormatType("core/underline");
            }
        }
        if (name) {
            registerFormatType(name, settings);
        }
    });
};

domReady(() => {
    stiellerRegisterFormats();
});
