let po_receiving = [];
let req_items = [];
let temp_inventory = [];
let temp_inventory_item = [];
let inventory_items_list = [];
let inventory_cnt = 0;
let series_start = 0;
let formData = new FormData();
let order_item = [];

let receiving_items = $("#receiving_items").DataTable({
    responsive: false,
    Destroy: true,
    paging: false,
    searching: false,
    scrollX: true,
    columns: [
        {
            data: null,
            title: "<b class='text-nowrap'> Branch </b>",
            render: function (data, type, row) {
                return `<b>${data.BranchName}</b>`;
            },
        },
        {
            data: null,
            title: "<b>Description</b>",
            render: function (data, type, row, meta) {
                return `<b>${data.description} </b>`;
            },
        },
        {
            data: null,
            title: "<b class='text-nowrap'>Received Qty </b>",
            render: function (data, type, row) {
                return `<b><input type="number" min="0" value="${data.rec_qty}"  class="form-control" onchange='' "></b>`;
            },
        },
        {
            data: null,
            title: "<b>BKT No.</b>",
            render: function (data, type, row) {
                let json = JSON.stringify(row);
                return `<b class='text-primary'>${data.bkt_no}</b>`;
            },
        },
        {
            data: null,
            title: "<b> Copy per Set </b>",
            render: function (data, type, row) {
                return `<b class='text-primary'><input id="" type="number" value="${data.copy_qty}" class="form-control"></b>`;
            },
        },
        {
            data: null,
            title: "<b> SERIES START </b>",
            render: function (data, type, row) {
                let json = JSON.stringify(row);
                return `<b class='text-primary'><input type="number" value="${data.series_start}" onchange="" value="4"  id=""  class="form-control"></b>`;
            },
        },
        {
            data: null,
            title: "<b> SERIES END </b>",
            render: function (data, type, row) {
                return `<b class='text-primary' id="series_end${data.id}">${data.series_end}</b>`;
            },
        },
        {
            data: null,
            title: "<b> Action </b>",
            render: function (data, type, row) {
                let html = `<b onclick='RemoveReceive(${JSON.stringify(
                    row
                )})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>`;

                html += `<b data-toggle='modal' onclick='CustomAdd(${JSON.stringify(
                    row
                )})' data-target='#custom_add' type="button" ><i class="btn ki ki-plus icon-1x text-success"></i></b>`;

                return html;
            },
        },
    ],
    columnDefs: [
        {
            targets: [0],
            className: "text-nowrap col-1",
        },
        {
            targets: [1],
            className: "text-nowrap col-1",
        },
        {
            targets: [2],
            className: "text-nowrap col-1",
        },
        {
            targets: [3],
            className: "text-wrap col-1",
        },
        {
            targets: [4],
            className: "text-wrap col-1",
        },
        {
            targets: [5],
            className: "text-nowrap col-1",
        },
        {
            targets: [6],
            className: "text-nowrap col-1",
        },
        {
            targets: [7],
            className: "text-nowrap col-1",
        },
    ],
});

let req_table = $("#req_table").DataTable({
    scrollY: "400px",
    scrollCollapse: true,
    paging: false,
    searching: false,
    columns: [
        {
            data: "quantity",
        },
        {
            data: "po_no",
        },
        {
            data: "description",
        },
        {
            data: "BranchName",
        },
        {
            data: "classification",
        },
        {
            data: null,
            render: function (data, type, row, index) {
                return `<b class="text-success" onclick='AddReceiving(${JSON.stringify(
                    row
                )})'><i class="btn ki ki-solid-plus icon-2x text-success"></i><b>`;
            },
        },
    ],
});

let custom_table = $("#inventory_custom_add").DataTable({
    responsive: false,
    Destroy: true,
    paging: true,
    searching: true,
    scrollX: true,
    columns: [
        {
            data: null,
            title: "<b>Quantity</b>",
            render: function (data, type, row, meta) {
                return `<b>${data.quantity} </b>`;
            },
        },
        {
            data: null,
            title: "<b class='text-nowrap'> Units </b>",
            render: function (data, type, row) {
                return `<b>${data.unit}</b>`;
            },
        },
        {
            data: null,
            title: "<b>Description</b>",
            render: function (data, type, row) {
                return `<b class='text-primary'>${data.description}</b>`;
            },
        },
        {
            data: null,
            title: "<b>Set Per Item</b>",
            render: function (data, type, row) {
                return `<input class='form-control' onchange='OnchangeSetValue(this.value,${JSON.stringify(
                    data
                )})' value='${data.set_qty == 0 ? 50 : data.set_qty}' id="set${
                    data.booklet
                }" type="text" name='set_per_item'>`;
            },
        },
        {
            data: null,
            title: "<b> BOOKLET </b>",
            render: function (data, type, row) {
                return `<b class='text-primary'>${data.booklet}</b>`;
            },
        },
        {
            data: null,
            title: "<b> SERIES START </b>",
            render: function (data, type, row) {
                return `<input class='form-control' id="start${data.booklet}" value='${data.series_start}' type="text" name='series_start'>`;
            },
        },
        {
            data: null,
            title: "<b> SERIES END </b>",
            render: function (data, type, row) {
                return `<input class='form-control' id="end${data.booklet}" value='${data.series_end}' type="text" name='series_end'>`;
            },
        },
        {
            data: null,
            title: "<b> Added </b>",
            render: function (data, type, row) {
                return `<b > <input id="chk${row.order_id}${
                    row.booklet
                }" onclick='addInventory(${JSON.stringify(
                    row
                )},this)'  type="checkbox"  ${row.active}/></b>`;
            },
        },
    ],
    columnDefs: [
        {
            targets: [0],
            className: "text-wrap col-1",
        },
        {
            targets: [1],
            className: "text-wrap col-1",
        },
        {
            targets: [2],
            className: "text-wrap col-1",
        },
        {
            targets: [3],
            className: "text-wrap col-2",
        },
        {
            targets: [4],
            className: "text-wrap col-1",
        },
        {
            targets: [5],
            className: "text-wrap col-2",
        },
        {
            targets: [6],
            className: "text-wrap col-2",
        },
        {
            targets: [7],
            className: "text-wrap col-1",
        },
    ],
});

let inventory_items = $("#inventory_items").DataTable({
    responsive: false,
    Destroy: true,
    paging: true,
    searching: false,
    scrollX: true,
    columns: [
        {
            data: null,
            title: "<b>Quantity</b>",
            render: function (data, type, row, meta) {
                return `<b>${data.quantity} </b>`;
            },
        },
        {
            data: null,
            title: "<b class='text-nowrap'> Units </b>",
            render: function (data, type, row) {
                return `<b>${data.unit}</b>`;
            },
        },

        {
            data: null,
            title: "<b>Description</b>",
            render: function (data, type, row) {
                return `<b class='text-primary'>${data.description}</b>`;
            },
        },
        {
            data: null,
            title: "<b>Set Per Item</b>",
            render: function (data, type, row) {
                return `<b class='text-primary'>${data.set_qty}</b>`;
            },
        },
        {
            data: null,
            title: "<b> Booklets </b>",
            render: function (data, type, row) {
                return `<b class='text-primary'>${data.booklet}</b>`;
            },
        },
        {
            data: null,
            title: "<b> SERIES START </b>",
            render: function (data, type, row) {
                return `<b class='text-primary'>${data.series_start}</b>`;
            },
        },
        {
            data: null,
            title: "<b> SERIES END </b>",
            render: function (data, type, row) {
                return `<b class='text-primary'>${data.series_end}</b>`;
            },
        },
        {
            data: null,
            title: "<b> Action </b>",
            render: function (data, type, row) {
                return `<b onclick='removeItem(${JSON.stringify(
                    row
                )})'><i class="btn ki ki-bold-close icon-1x text-danger"></i></b>`;
            },
        },
    ],
    columnDefs: [
        {
            targets: [0],
            className: "text-nowrap col-1",
        },
        {
            targets: [1],
            className: "text-nowrap col-1",
        },
        {
            targets: [2],
            className: "text-nowrap col-1",
        },
        {
            targets: [3],
            className: "text-nowrap col-1",
        },
        {
            targets: [4],
            className: "text-nowrap col-1",
        },
        {
            targets: [5],
            className: "text-nowrap col-1",
        },
        {
            targets: [6],
            className: "text-nowrap col-1",
        },
        {
            targets: [7],
            className: "text-nowrap col-1",
        },
    ],
});

// PO requesy that are ready for receiving

// get data from database PO requests
function getPOforReceiving() {
    axios
        .get("/get-po-for-receiving")
        .then(function (response) {
            req_items = response.data;
            req_table.search("").columns().search("").clear().draw();
            req_table.rows.add(response.data).draw(true);
        })
        .catch(function (error) {});
}

function AddReceiving(row) {
    row["order_index"] = po_receiving.length;
    row.series_start = 0;
    row.series_end = 0;
    row.bkt_no = "";
    row.rec_qty = 0;
    row.copy_qty = 4;
    po_receiving.push(row);

    receiving_items.search("").columns().search("").clear().draw();
    receiving_items.rows.add(po_receiving).draw(true);

    getOrderlineItems(row.olid);

    // add data to temporary inventory
    // end

    CustomTable(temp_inventory);
}

function getOrderlineItems(olid) {
    try {
        let allResponses = [];
        axios
            .get(`/get-orderline-items/${olid}`, formData)
            .then(function (response) {
                let responseData = response.data;
                temp_inventory = temp_inventory.concat(response.data);
            })
            .catch(function (error) {
                Swal.fire({
                    title: "ERROR",
                    text: error,
                    icon: "error",
                });
            });
    } catch (error) {
        console.log(error);
    }
}

//onclickfunction to see items  in order line//
function CustomAdd(row) {
    order_item = temp_inventory.filter(function (item) {
        return item.olid === row.olid;
    });

    CustomValue(order_item, row.series_no);
}

// add to inventory table
function addInventory(row, check) {
    console.log(po_receiving);
    let counter = [];
    console.log(check.checked);

    let index = temp_inventory.findIndex((item) => item.id === row.id);

    if (check.checked) {
        // Add Item to Inventory List
        temp_inventory[index].active = "checked";
        //
        row["row_cnt"] = inventory_items_list.length;

        inventory_items_list.push(row);
        console.log(inventory_items_list);
    } else {
        removeItem(row);
    }

    // sort the data
    inventory_items_list = inventory_items_list.sort(function (a, b) {
        return a.booklet - b.booklet;
    });

    // set the series number values start and end
    setSeriesValue(row.olid);

    inventory_items.search("").columns().search("").clear().draw();
    inventory_items.rows.add(inventory_items_list).draw(true);

    counter = inventory_items_list.filter(function (item) {
        return item.order_id === row.order_id;
    });
}

function setSeriesValue(id) {
    let index = po_receiving.findIndex((item) => item.olid === id);
    let quantity = inventory_items_list.filter(function (item) {
        return item.olid === id;
    });

    let cnt = po_receiving.length;

    let booklets = concatinateValue(quantity, "booklet");

    po_receiving[index].series_start =
        quantity.length == 0 ? 0 : quantity[0].series_start;
    po_receiving[index].series_end =
        quantity.length == 0 ? 0 : quantity[quantity.length - 1].series_end;
    po_receiving[index].rec_qty = quantity.length == 0 ? 0 : quantity.length;
    po_receiving[index].bkt_no = booklets;

    receiving_items.search("").columns().search("").clear().draw();
    receiving_items.rows.add(po_receiving).draw(true);
}

function OnchangeSetValue(val, row) {
    let index = order_item.findIndex((item) => item.id === row.id);
    order_item[index].set_qty = parseInt(val);
    console.log(order_item);

    CustomValue(order_item, row.series_start);
}

function CustomValue(data, start_series) {
    let series_start = start_series;
    data[0].set_qty = data[0].set_qty || 50;
    data[0].series_start = data[0].series_start || start_series;
    data[0].series_end = series_start + parseInt(data[0].set_qty);

    for (let index = 1; index < data.length; index++) {
        data[index].set_qty = data[index].set_qty || 50;
        data[index].series_start = data[index - 1].series_end + 1;

        data[index].series_end =
            data[index].series_start + parseInt(data[index].set_qty) - 1;
    }

    temp_inventory_item = data;
    CustomTable(temp_inventory_item);
}

function onchangeQuantity(qty, row) {
    let set_qty = parseInt($(`#spi${row.id}${row.order_index}`).val());
    let item_qty = parseInt(qty);
    let series_start = parseInt($(`#start${row.id}${row.order_index}`).val());
    let copy_cnt = parseInt($(`#copy${row.id}${row.order_index}`).val());
    let bktno = parseInt($(`#bkt${row.id}${row.order_index}`).val());

    custom_table.search("").columns().search("").clear().draw();
    let series_end = set_qty * item_qty + (series_start - 1);

    // SET VALUE OF RECEIVED ITEM, SET PER ITEM, COPY PER SET, SERIES START, SERIES END
    let index = po_receiving.findIndex(
        (item) => item.id === row.id && item.order_index === row.order_index
    );

    po_receiving[index].rec_qty = qty;
    po_receiving[index].set = set_qty;
    po_receiving[index].copy = copy_cnt;
    po_receiving[index].start = series_start;
    po_receiving[index].end = series_end;
    po_receiving[index].booklet = bktno;
    // END
    // console.log(po_receiving);

    $(`#series_end${row.id}${row.order_index}`).html(series_end);
}

function RemoveReceive(row) {
    // Now, you can remove the item from po_items as follows:

    let index = po_receiving.findIndex(
        (item) => item.order_index === row.order_index
    );
    console.log(inventory_items_list);
    inventory_items_list = inventory_items_list.filter(function (item) {
        return item.olid != row.id;
    });

    temp_inventory_item = temp_inventory_item.filter(function (item) {
        return item.olid != row.id;
    });

    inventory_items.search("").columns().search("").clear().draw();
    inventory_items.rows.add(inventory_items_list).draw(true);
    custom_table.search("").columns().search("").clear().draw();
    custom_table.rows.add(temp_inventory).draw(true);

    if (index !== -1) {
        po_receiving.splice(index, 1);
        receiving_items.search("").columns().search("").clear().draw();
        receiving_items.rows.add(po_receiving).draw(true);
    }
}

// add item to receiving items

function CustomTable(data) {
    custom_table.search("").columns().search("").clear().draw();
    custom_table.rows.add(data).draw(true);
}

// data in receiving form submit
function SubmitReceivingInventory(event) {
    event.preventDefault();
    var form = event.target; // Get the form element
    var formData = new FormData(form);
    formData.append("receiving_items", JSON.stringify(po_receiving));
    formData.append("inventory_items", JSON.stringify(inventory_items_list));
    $("#btn-save").prop("disabled", true);

    axios
        .post("/add-receiving-order", formData)
        .then(function (response) {
            Swal.fire("Created Successfully", response.data, "success");
            form.reset();
            $("#btn-save").prop("disabled", false);
        })
        .catch(function (error) {
            Swal.fire({
                title: "ERROR",
                text: error,
                icon: "error",
            });
        });
}

//clear inventory
function clearInventoryItems() {
    inventory_items_list = [];
    for (let i = 0; i < temp_inventory.length; i++) {
        temp_inventory[i].active = "";
    }

    inventory_items.search("").columns().search("").clear().draw();
    inventory_items.rows.add(inventory_items_list).draw(true);
}
// end

// custom add to inventory list
function concatinateValue(data, column) {
    let concatenatedValues = data.reduce((acc, obj, index) => {
        let separator = index === 0 ? "" : ", ";
        return acc + separator + obj[column];
    }, " ");

    return concatenatedValues;
}

// remove from inventory table
function removeItem(row) {
    let index = inventory_items_list.findIndex(
        (item) => item.row_cnt === row.row_cnt
    );
    let item_index = temp_inventory.findIndex((item) => item.id === row.id);

    temp_inventory[item_index].active = "unchecked";

    let order_received = parseInt(
        $(`#qty${row.order_id}${row.order_index}`).val()
    );

    inventory_items_list.splice(index, 1);

    inventory_items_list = inventory_items_list.sort(function (a, b) {
        return a.booklet - b.booklet;
    });

    // set the series number values start and end
    setSeriesValue(row.olid);

    inventory_items.search("").columns().search("").clear().draw();
    inventory_items.rows.add(inventory_items_list).draw(true);

    temp_inventory[index_temp]["active"] = "";
    $(`#qty${row.order_id}${row.order_index}`).val(order_received - 1);
}
// end
$("#req_list").on("shown.bs.modal", function () {
    // Initialize or redraw the DataTable here

    $("#req_table").DataTable().draw();
});
$("#custom_add").on("shown.bs.modal", function () {
    // Initialize or redraw the DataTable here
    $("#inventory_custom_add").DataTable().draw();
});

$(document).ready(async function () {
    await getPOforReceiving();
});

// end
