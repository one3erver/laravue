async function imgToBase64(image, callback) {
    const reader = new FileReader();

    reader.readAsDataURL(image);

    reader.onload = async function (event) {
        const imgElm = document.createElement("img");
        imgElm.src = event.target.result;

        const r = (imgElm.onload = async function (e) {
            const canves = document.createElement("canvas");
            const MAX_WIDTH = 25;
            const scale = MAX_WIDTH / e.target.width;

            canves.width = MAX_WIDTH;
            canves.height = e.target.height * scale;

            const ctx = canves.getContext("2d");

            ctx?.drawImage(e.target, 0, 0, canves.width, canves.height);
            await ctx?.canvas.toBlob((blob) => {
                if (!blob) {
                    return;
                }
                const _file = new File([blob], "lowResImage", { type: "image/jpeg" });
                const reader = new FileReader();
                reader.addEventListener("load", async () => {
                    reader.result && callback(reader.result.toString());
                });
                reader.readAsDataURL(_file);
            });
        });
    };
}
