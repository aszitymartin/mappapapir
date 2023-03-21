<div class="flex flex-col gap-025">
    <div class="flex flex-row flex-align-c flex-justify-con-sb gap-05">
        <h2 class="text-primary bold margin-none padding-0" id="product-title"></h2>
    </div>
    <div class="flex flex-col gap-05">
        <div class="flex flex-col flex-align-c gap-05">
            <div class="flex flex-row flex-align-c gap-05 text-align-l w-fa">
                <div class="flex flex-row flex-align-c">
                    <span class="small-med" id="star__ind"></span>
                    <span class="small-med text-muted bold" id="star__count"></span>
                </div>
                <span class="text-primary-light link user-select-none pointer small-med" id="rvc__ind"></span>
            </div>
            <div id="bestseller-con" class="flex w-fa"></div>
            <script>
                console.log(pid)

                var bestSellerData = new FormData(); 
                const bestSellerObject = {
                    action : 'isBestSeller',
                    pid  : pid
                };

                bestSellerData.append('product', JSON.stringify(bestSellerObject));
                const ajaxObject = {
                    url : '/assets/php/classes/class.Products.php',
                    data : bestSellerData,
                    loaderContainer : { isset : false }
                };

                $(document).ready(() => {
                    let response = getFromAjaxRequest(ajaxObject)
                    .then((data) => { console.log(data);

                        if (data.status == 'success') {
                            if (data.isBestSeller) {
                                document.getElementById('bestseller-con').innerHTML = `
                                <div class="flex flex-row flex-align-c flex-justify-con-l smaller gap-05 pointer user-select-none w-fa">
                                    <span class="primary-bg border-soft-light padding-025 bold">#1 Bestseller</span>
                                    <a href="/search/${data.category}" class="text-muted link smaller-light">${data.category} kategóriában</a>
                                </div>           
                                `;
                            }
                        }

                    }) .catch((reason) => { console.log(reason); });
                });

            </script>
            
        </div>
        <div class="flex flex-row flex-align-c gap-05" id="product-tags-con"></div>
    </div>
</div><hr style="border: 1px solid var(--background);" class="w-100">