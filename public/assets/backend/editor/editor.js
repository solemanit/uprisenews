// Summernote — strip ALL paste formatting + clean whitespace

$(function () {
    $("#editor").summernote({
        height: 320,
        toolbar: [
            ["style", ["bold", "italic"]],
            ["para", ["ul", "ol", "paragraph"]],
        ],

        callbacks: {
            onPaste: function (e) {
                e.preventDefault();

                const cd =
                    e.originalEvent.clipboardData || window.clipboardData;
                const raw = extractPlain(cd); // step 1: always plain text
                const clean = cleanWhitespace(raw); // step 2: whitespace
                const html = toHtml(clean); // step 3: rebuild structure

                $("#editor").summernote("pasteHTML", html);
            },
        },
    });
});

function extractPlain(cd) {
    const plain = cd.getData("text/plain");
    if (plain) return plain;

    const html = cd.getData("text/html");
    if (!html) return "";

    const tmp = document.createElement("div");
    tmp.innerHTML = html;

    // Block-level → newline before & after
    tmp.querySelectorAll("p,div,li,h1,h2,h3,h4,h5,h6,blockquote,tr").forEach(
        (el) => {
            el.prepend("\n");
            el.append("\n");
        },
    );
    tmp.querySelectorAll("br").forEach((br) => br.replaceWith("\n"));

    return tmp.textContent || "";
}

// ── Step 2: clean whitespace ──────────────────────────────────
function cleanWhitespace(text) {
    return text
        .replace(/\r\n/g, "\n") // CRLF → LF
        .replace(/\r/g, "\n") // CR → LF
        .replace(/\t/g, " ") // tab → space
        .replace(/[^\S\n]+/g, " ") // multiple spaces → one
        .replace(/ *\n */g, "\n") // space around newlines
        .replace(/\n{3,}/g, "\n\n") // 3+ blank lines → 1
        .replace(/^\n+|\n+$/g, ""); // leading/trailing newlines
}

// ── Step 3: plain text → HTML structure ──────────────────────
// double newline  →  new <p>
// single newline  →  <br>

function toHtml(text) {
    if (!text) return "<p></p>";

    return text
        .split(/\n{2,}/)
        .filter((p) => p.trim() !== "") // skip empty paragraphs
        .map((p) => {
            const inner = p
                .split("\n")
                .map((line) => line.trim())
                .filter((line) => line !== "")
                .map(escapeHtml)
                .join("<br>");
            return `<p>${inner}</p>`;
        })
        .join("");
}

function escapeHtml(s) {
    return s
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;");
}
