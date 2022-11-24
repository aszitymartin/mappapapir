function openFeedback(getItem) { var item = getItem;
    $.ajax({
        enctype: "multipart/form-data", type: "POST", url: "actions/feedback_action.php", data: {id: item.getAttribute('feedbackid'), status: item.getAttribute('feedbackstatus'), type: item.getAttribute('feedbacktype')}, dataType: 'json',
        // Sikeres/Sikertelen akciok kimenetelenek lekezelese ertesitesekkel, hogy emberbaratabb legyen az oldal.
        success: function(data) {
            blur(); const feedback = document.createElement('div');feedback.classList = "feedback flex flex-col border-soft box-shadow item-bg absolute";
            feedback.innerHTML = `
                <div class="feedback-inner flex flex-col padding-1 gap-1 h-100">
                    <div class="feedback-header flex flex-row flex-align-c flex-justify-con-sb w-100">
                        <div class="flex flex-row flex-align-c flex-justify-con-sb w-100">
                            <span class="header_title_heading">${data.feedback_title}</span>
                            <span class="flex">
                                <span class="text-primary pointer" onclick="closeFeedback()">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"></circle><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg"></path></g>
                                    </svg>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="feedback-main flex flex-col gap-1">
                        <div class="feedback-main-header flex flex-align-c flex-justify-con-sb w-100">
                            <div class="flex flex-col">
                                <span class="text-primary bold">${data.author_name}</span>
                                <span class="text-secondary underline pointer"><em><a href="mailto:${data.author_email}">${data.author_email}</a></em></span>
                            </div>
                            <div class="flex">
                                <span class="text-secondary bold small">${data.feedback_created}</span>
                            </div>
                        </div>
                        <div class="feedback-message flex flex-col gap-05">
                            <div class="flex background-bg padding-1 border-soft">
                                <span class="text-secondary">${data.feedback_desc}</span>
                            </div>
                            <div class="flex flex-row gap-05" style="margin: 0 1rem; justify-content: flex-end">
                                <span class="text-secondary smaller pointer"><em>Mobile</em></span>
                                <span class="text-secondary smaller pointer"><em>iOS</em></span>
                                <span class="text-secondary smaller pointer"><em>Safari</em></span>
                                <span class="text-secondary smaller pointer"><em>Hungary</em></span>
                            </div>
                        </div>
                        <div class="feedback-reply flex flex-col">
                            <textarea class="background-bg" name="feedback-reply" id="feedback-reply" placeholder="Válaszoljon erre a visszajelzésre." required></textarea>
                            <span class="textarea-tools flex flex-row flex-align-c flex-justify-con-sb padding-05 gap-1 background-bg">
                                <div class="flex flex-align-fe gap-05">
                                    <span class="text-secondary smaller bold"><span id="word-counter">0</span> / 2048</span>
                                </div>
                                <div class="flex flex-align-c flex-justify-con-fe gap-05">
                                    <span class="pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.2rem" height="1.2rem" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" class="svg"/></g>
                                        </svg>
                                    </span>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="feedback-footer flex flex-row flex-align-c flex-justify-con-sb gap-1 margin-top-a">
                        <div class="flex flex-align-c flex-row gap-1">
                            <span class="flex flex-align-c flex-justify-con-c flex-col pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" class="svg"/><path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" class="svg" opacity="0.3"/></g></svg>
                                <span class="smaller text-primary bold user-select-none">Kivizsgálás</span>
                            </span>
                            <span class="flex flex-align-c flex-justify-con-c flex-col pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z" class="svg"/><path d="M8.4472136,18.1055728 C8.94119209,18.3525621 9.14141644,18.9532351 8.89442719,19.4472136 C8.64743794,19.9411921 8.0467649,20.1414164 7.5527864,19.8944272 L5,18.618034 L5,14.5 C5,13.9477153 5.44771525,13.5 6,13.5 C6.55228475,13.5 7,13.9477153 7,14.5 L7,17.381966 L8.4472136,18.1055728 Z" class="svg" fill-rule="nonzero" opacity="0.3"/></g></svg>
                                <span class="smaller text-primary bold user-select-none">Elhalasztás</span>
                            </span>
                        </div>
                        <div class="flex flex-align-c flex-row gap-1">
                            <span class="flex flex-align-c flex-justify-con-c flex-col pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" class="svg"></path></g></svg>
                                <span class="smaller text-primary bold user-select-none">Archiválás</span>
                            </span>
                            <span class="flex flex-align-c flex-justify-con-c flex-col pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z" class="svg"/><path d="M8,17 C8.55228475,17 9,17.4477153 9,18 L9,21 C9,21.5522847 8.55228475,22 8,22 L3,22 C2.44771525,22 2,21.5522847 2,21 L2,18 C2,17.4477153 2.44771525,17 3,17 L3,16.5 C3,15.1192881 4.11928813,14 5.5,14 C6.88071187,14 8,15.1192881 8,16.5 L8,17 Z M5.5,15 C4.67157288,15 4,15.6715729 4,16.5 L4,17 L7,17 L7,16.5 C7,15.6715729 6.32842712,15 5.5,15 Z" class="svg" opacity="0.3"/></g></svg>
                                <span class="smaller text-primary bold user-select-none">Lezárás</span>
                            </span>
                        </div>
                    </div>
                </div>
            `; document.body.append(feedback); feedback.style.height = "100vh";
        },
        error: function (err) { console.log(err.responseText); }
    });
}