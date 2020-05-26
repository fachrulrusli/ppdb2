var Consyst = function () {
    var handleAjaxLink = function () {
        $('.ajax').click(function () {

            var url = $(this).attr('href');
            url = url.substring(1, url.lenght);
            if (url) {
                $.ajax({
                    url: url
                }).done(function (data) {
                    $('.page-content').empty().html(data.html);

                })
            }
        });
    };
    var handleAjaxParam = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                App.blockUI({
                    boxed: true
                });
            },
            timeout: function () {
                Consyst.msgError("Error", "Request timeout please try again");
                App.unblockUI();
            },
            complete: function () {
                App.unblockUI();

            },
            success: function () {
                App.unblockUI();

            },
            error: function (jqXHR, textStatus, errorThrown) {
                App.unblockUI();

                if (jqXHR.status == '404') {
                    Consyst.loadForm('/404');
                } else {
                    $('.page-content').empty().html(jqXHR.responseText);

                }


            },
            fail: function (jqXHR, textStatus) {
                App.unblockUI();
                Consyst.msgError("Error", jqXHR.statusText);

            }

        });
    };

    var handleAjaxProcess = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {

            },
            timeout: function () {
                Consyst.dialogErrorX("Request timeout please try again");

            },
            complete: function () {

                App.destroySlimScroll();

            },
            success: function () {
                App.destroySlimScroll();

            },
            error: function (jqXHR, textStatus, errorThrown) {
                Consyst.dialogErrorX("Terjadi error pada saat proses ini \n \n <pre>" + jqXHR.responseText + " </pre>");


            },
            fail: function (jqXHR, textStatus) {
                Consyst.dialogErrorX("Terjadi error pada saat proses ini \n \n <pre>" + jqXHR.responseText + " </pre>");

            }

        });
    }
    return {
        //main function to initiate the module
        init: function () {
            handleAjaxLink();
            handleAjaxParam();
            $.fn.modal.Constructor.prototype.enforceFocus = function () {
            };


        },
        msgInfo: function (title, msg) {
            toastr.clear();
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr["success"](msg, title);
        },
        msgError: function (title, msg) {
            toastr.clear();
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr["error"](msg, title);
        },
        msgErrorX: function (msg) {
            DevExpress.ui.notify(msg, "error", 600);
        },
        msgInfoX: function (tittle, msg, flag) {
            if (flag == null) {
                flag = true;
            }
            popupOptions = {
                title: tittle,
                contentTemplate: function () {
                    return msg;
                },
                closeOnBackButton: none,
                closeOnOutsideClick: none,
                visible: true,
                width: 300,
                height: 150,
                showCloseButton: none
            };
            $('#popup').html("");
            popup = $('#popup').dxPopup(
                popupOptions).dxPopup("instance").hide();
            var showInfo = function () {

                popup = $('#popup').dxPopup(
                    popupOptions).dxPopup("instance");
                popup.show();
            };
            showInfo();
        },

        loadMenu: function (selector) {
            var data = $(selector).attr('dataurl');
            var id = $(selector).attr('dataid');
            if (data != null) {
                if (data != '#') {
                    loadForm(data.substring(1, data.lenght));
                } else {
                    var url = '/container/' + id;
                    if (url) {
                        $.ajax({
                            url: url
                        }).done(function (data) {
                            $('.page-content').empty().html(data.html);

                        })
                    }
                }
            }

        },
        loadForm: function (url) {
            $.ajax({
                url: url
            }).done(function (data) {
                $('.page-content').empty().html(data.html);
            })
        },
        ajaxEdit: function (selector) {
            var url = $(selector).attr('data');
            $.ajax({
                url: url
            }).done(function (data) {
                $('.page-content').empty().html(data.html);
            })
        },

        generateStatusButton: function (id, uri, value) {
            var rtn;
            if (value == 1) {
                rtn = '<a href="#" data="' + uri + '" class="label label-success" id="rs-' + id + '" onclick=ajaxChangeStatus("#rs-' + id + '")><i class="glyphicon glyphicon-ok"></i> Aktif </a>';
            } else {
                rtn = '<a href="#" data="' + uri + '" class="label label-danger" id="rs-' + id + '" onclick=ajaxChangeStatus("#rs-' + id + '")><i class="glyphicon glyphicon-remove"></i> Non Aktif </a>';
            }
            return rtn;
        },

        generateResetButton: function (id, uri) {
            var rtn;
                rtn =   '<div class="btn-group">' +
                        '<a href="#" data="' + uri + '" class="label label-warning" id="rpa-' + id + '" onclick=ajaxReset("#rpa-' + id + '")><i class="fa fa-unlock"></i>Reset</a>';
                        '</div>';
            return rtn;
        },
        generateOtorButton: function (id, uri, value) {
            var rtn;
            if (value == 0) {
                rtn = '<a href="#" data="' + uri + '" class="label label-success" id="ro-' + id + '" onclick=ajaxOtor("#ro-' + id + '")><i class="glyphicon glyphicon-ok"></i> Approve </a>';
            } else {
                rtn = '<a href="#" data="' + uri + '" class="label label-danger" id="ro-' + id + '" onclick=ajaxOtor("#ro-' + id + '")><i class="glyphicon glyphicon-remove"></i> Approve </a>';
            }
            return rtn;
        },
        showNoticeNotify: function (title, msg) {
            Consyst.msgError(title, msg);
        },
        showInfoNotify: function (title, msg) {
            Consyst.msgInfo(title, msg);
        },
        generateFlagButton: function (id, value) {
            var rtn;
            if (value == 1) {
                rtn = '<a href="#" class="label label-success btnboolean" id="bf-' + id + '"><i class="glyphicon glyphicon-ok"></i> </a>';
            } else {
                rtn = '<a href="#" class="label label-danger btnboolean" id="bf-' + id + '"><i class="glyphicon glyphicon-remove"></i></a>';
            }
            return rtn;
        },
        generateEditButton: function (id) {
            var rtn;

            rtn = '<a href="#" class="label label-success btnboolean" id="be-' + id + '" ><i class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Ubah"></i> Ubah</a>';

            return rtn;
        },

         generatePilihButton: function (id) {
            var rtn;

            rtn = '<a href="#" class="label label-warning btnboolean" id="be-' + id + '" ><i class="glyphicon glyphicon-open" data-toggle="tooltip" title="Pilih"></i> Pilih</a>';

            return rtn;
        },
        generateProgressBarAnimated: function () {
            var rtn = '<div class="progress progress-striped active">';
            rtn += '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">';
            rtn += '<span class="sr-only"> 100% Complete (success) </span>';
            rtn += '</div>';
            rtn += '</div>';
            return rtn;
        },
        showValidationError: function (msg, container) {
            App.alert({
                container: container,
                place: 'append',
                type: 'danger', // alert's type
                message: msg, // alert's message
                close: 'true' // make alert closable

            });
        },
        genereteStatusButtonXtraGrid: function (status) {

            var rtn = '<a href="#" class="label {label}"><i class="{icon}"></i> </a>';

            if (status == 1) {
                rtn = rtn.replace('{label}', 'label-success');
                rtn = rtn.replace('{icon}', 'glyphicon glyphicon-ok');

            } else if (status == 0) {
                rtn = rtn.replace('{label}', 'label-danger');
                rtn = rtn.replace('{icon}', 'glyphicon glyphicon-remove');

            } else {
                rtn = rtn.replace('{label}', 'label-danger');
                rtn = rtn.replace('{icon}', 'glyphicon glyphicon-remove');

            }
            return rtn;
        },
        genereteStatusButtonXtraGrid2: function (status) {

            var rtn = '<a href="#" class="label {label}">{txt}<i class="{icon}"></i> </a>';

            if (status == 1) {
                rtn = rtn.replace('{label}', 'label-success');
                rtn = rtn.replace('{txt}', '  Aktif  ');

            } else if (status == 0) {
                rtn = rtn.replace('{label}', 'label-warning');
                rtn = rtn.replace('{txt}', '  Belum Aktif  ');
            } else {
                rtn = rtn.replace('{label}', 'label-danger');
                rtn = rtn.replace('{txt}', '  Blokir  ');
            }
            return rtn;
        },
        genereteStatusButtonXtraGrid3: function (status) {

            var rtn = '<a href="#" class="label {label}">{txt}<i class="{icon}"></i> </a>';

            if (status == 0) {
                rtn = rtn.replace('{label}', 'label-success');
                rtn = rtn.replace('{txt}', '  Aktif  ');

            } else {
                rtn = rtn.replace('{label}', 'label-danger');
                rtn = rtn.replace('{txt}', '  Blokir  ');
            }
            return rtn;
        },

        InitGridX: function (selector) {

            $(selector).dxDataGrid({
                loadPanel: {
                    enabled:false
                },

                showColumnLines: true,
                showRowLines: true,
                showBorders: true,
                paging: {
                    pageSize: 100
                },

                groupPanel: {
                    visible: true
                },
                filterRow: {
                    visible: true,
                    applyFilter: "auto"
                },
                headerFilter: {
                    visible: true,
                    allowSearch:true
                },

                columnAutoWidth:true,
                allowColumnResizing: true,
                columnResizingMode: "nextColumn",
                showScrollbar: 'always',
                grouping: {
                    autoExpandAll: true
                },
                pager: {
                    showPageSizeSelector: true,
                    allowedPageSizes: [20, 50],
                    showInfo: true
                },
                searchPanel: {
                    visible: true,
                    width: 240,
                    placeholder: "Search..."
                },



            });
            $(selector).css('font-size', '12px');
        },
        disableAjaxGlobal: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {

                },
                timeout: function () {

                },
                complete: function () {

                },
                success: function () {

                },
                error: function (jqXHR, textStatus, errorThrown) {


                },
                fail: function (jqXHR, textStatus) {

                }

            });
        },

        dialogInfoX: function (title, msg) {
            swal({
                title: title,
                text: msg,
                type: "success",
                showCancelButton: false,
                closeOnCancel: false
            });

        },
        dialogErrorX: function (msg) {
            swal({
                title: "Error!",
                text: msg,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                closeOnConfirm: false,
                closeOnCancel: false,
                html: true
            });
        },
        GenerateColoumn: function (awal) {
            var monthNames = ["Januari", "Febuari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            var rtn = [];
            var bulan = parseInt(awal.substring(4, 6));
            var tahun = parseInt(awal.substring(0, 4));
            var i;
            var iterator = 0;
            for (i = 0; i < 12; i++) {

                if (i === 0) {

                    bulan = bulan - 1;
                    iterator = 1;
                }
                bulan = bulan + 1;
                if (parseInt(bulan) === 13) {
                    tahun = parseInt(tahun) + 1;
                    bulan = 1;
                }
                //rtn.push({caption:tahun + this.pad(parseInt(bulan) ,2),dataField:'bln'+iterator,caption:monthNames[parseInt(bulan)]+' ' + tahun})
                rtn.push({
                    dataField: 'bln_' + iterator,
                    caption: monthNames[parseInt(bulan) - 1] + ' ' + tahun,
                    alignment: "right",
                    dataType: "number",
                    format: 'decimal fixedPoint',
                    width: 100
                });
                iterator = iterator + 1;


            }
            return rtn;
        },
        pad: function (num, size) {
            var s = num + "";
            while (s.length < size) s = "0" + s;
            return s;
        },
        CalculateJumlahTHR: function (rowData) {
            return rowData.bln_1 +
                rowData.bln_2 +
                rowData.bln_3 +
                rowData.bln_4 +
                rowData.bln_5 +
                rowData.bln_6 +
                rowData.bln_7 +
                rowData.bln_8 +
                rowData.bln_9 +
                rowData.bln_10 +
                rowData.bln_11 +
                rowData.bln_12
        },
        isNumber:function (evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            return !(charCode > 31 && (charCode < 48 || charCode > 57));

        },
        GetTextboxID:function()
        {

            $('#form-post-data input[type="text"]').each(function(){
                console.log($(this).attr('id'));
            })
        },
        GenerateColoumn2: function (tgl1,tgl2) {
      
            var date1 = tgl1;
            var date2 = tgl2;

            date1 = date1.split('-');
            date2 = date2.split('-');

            date1 = new Date(date1[0], date1[1], date1[2]);
            date2 = new Date(date2[0], date2[1], date2[2]);

            date1_unixtime = parseInt(date1.getTime() / 1000);
            date2_unixtime = parseInt(date2.getTime() / 1000);

            var timeDifference = date2_unixtime - date1_unixtime;

            var timeDifferenceInHours = timeDifference / 60 / 60;

            var timeDifferenceInDays = timeDifferenceInHours  / 24;
            // console.log(timeDifferenceInDays);

            var rtn = [];
            var bulan1 =  String(tgl1).substr(5, 2);
            var tahun1 =  String(tgl1).substr(0, 4);
            var bulan2 =  String(tgl2).substr(5, 2);
            var tahun2 =  String(tgl2).substr(0, 4);

            var i;
            var iterator = tgl1;
            for (i = 0; i <= timeDifferenceInDays; i++) {

                var days= [i]; // This is an array of integers

                $.each(days, function(key,value){

                    var start = new Date(tgl1);
                    var nextDay = new Date(start);
                    nextDay.setDate(start.getDate()+value);
                    iterator = convert(nextDay);
                    var dd = nextDay.getDate();

                    var mm = nextDay.getMonth()+1; 
                    var yy = nextDay.getFullYear().toString().substr(-2);
                    if(dd<10) 
                    {
                        dd='0'+dd;
                    } 
                    if(mm<10) 
                    {
                        mm='0'+mm;
                    } 
                    iterator2 = dd+'-'+mm+'-'+yy;
                 
                });

                rtn.push({
                    dataField: iterator,
                    caption: "["+iterator2+"]",
                    alignment: "center",
                

                    editCellTemplate: function(container, cellInfo) {
                      $('<div>').appendTo(container).dxTextArea({
                          text: cellInfo.data.iterator.replace(/<br>/g,"\n"),
                          onValueChanged: function(e) {
                           cellInfo.setValue(e.value.replace(/<br>/g,"\n"));
                           cellInfo.component.cellValue(cellInfo.rowIndex, "green", e.value);
                       }
                    });    
                    },

                    cellTemplate: function (container, cellInfo) {
                        
                        console.log(cellInfo.value)
                        if(cellInfo.value == 'S<br>')
                            $("<div>").html(cellInfo.value).css('background','#F08080').css('font-weight','bold').css('height','60px')
                            .appendTo(container); 
                        else if(cellInfo.value == 'I<br>')
                            $("<div>").html(cellInfo.value).css('background','#00FA9A').css('font-weight','bold').css('height','60px')
                            .appendTo(container); 
                        else if(cellInfo.value == 'C<br>')
                            $("<div>").html(cellInfo.value).css('background','#DEB887').css('font-weight','bold').css('height','60px')
                            .appendTo(container);
                        else if(cellInfo.value != null && cellInfo.value.substring(0,8) > '08:30:00')
                            $("<div>").html(cellInfo.value).css('background','#00FFFF').css('font-weight','bold').css('height','60px') 
                            .appendTo(container); 
                        else if(cellInfo.value === null)
                            $("<div>").html('LIBUR').css('background','#FF0000').css('color','white').css('font-weight','bold').css('height','60px')     
                            .appendTo(container);  
                        else
                            $("<div>").html(cellInfo.value)
                            .appendTo(container); 

                    },  

        



                });
                iterator = iterator + 1;


            }
            return rtn;
        }
    };
}();
jQuery(document).ready(function () {
    Consyst.init();
    App.init();
});

function convert(str) {
  var date = new Date(str),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
  return [date.getFullYear(), mnth, day].join("-");
}

function tandaPemisahTitik(b) {
    var _minus = false;
    if (b < 0) _minus = true;
    b = b.toString();
    b = b.replace(",", "");
    b = b.replace("-", "");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i - 1, 1) + "," + c;
        } else {
            c = b.substr(i - 1, 1) + c;
        }
    }
    if (_minus) c = "-" + c;
    return c;
}

function numbersonly(ini, e) {
    if (e.keyCode >= 49) {
        if (e.keyCode <= 57) {
            a = ini.value.toString().replace(",", "");
            b = a.replace(/[^\d]/g, "");
            b = (b == "0") ? String.fromCharCode(e.keyCode) : b + String.fromCharCode(e.keyCode);
            ini.value = tandaPemisahTitik(b);
            return false;
        } else if (e.keyCode <= 105) {
            if (e.keyCode >= 96) {
                //e.keycode = e.keycode - 47;
                a = ini.value.toString().replace(",", "");
                b = a.replace(/[^\d]/g, "");
                b = (b == "0") ? String.fromCharCode(e.keyCode - 48) : b + String.fromCharCode(e.keyCode - 48);
                ini.value = tandaPemisahTitik(b);
                //alert(e.keycode);
                return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else if (e.keyCode == 48) {
        a = ini.value.replace(",", "") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g, "");
        if (parseFloat(b) != 0) {
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    } else if (e.keyCode == 95) {
        a = ini.value.replace(",", "") + String.fromCharCode(e.keyCode - 48);
        b = a.replace(/[^\d]/g, "");
        if (parseFloat(b) != 0) {
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    } else if (e.keyCode == 8 || e.keycode == 46) {
        a = ini.value.replace(",", "");
        b = a.replace(/[^\d]/g, "");
        b = b.substr(0, b.length - 1);
        if (tandaPemisahTitik(b) != "") {
            ini.value = tandaPemisahTitik(b);
        } else {
            ini.value = "";
        }

        return false;
    } else if (e.keyCode == 9) {
        return true;
    } else if (e.keyCode == 17) {
        return true;
    } else {
        //alert (e.keyCode);
        return false;
    }

}

function bersihPemisah(ini) {
    a = ini.toString().replace(",", "");
    //a = a.replace(".","");
    return a;
}


