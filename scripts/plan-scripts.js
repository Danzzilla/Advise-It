id = document.getElementById("planid").innerHTML.split(" ");
let data = new DataTrain(id[1]);

document.querySelectorAll(".add").forEach(item => {
    item.addEventListener("click", event => {
        let id = event.target.value;
        let list = document.getElementById(id + "List");
        let content = document.getElementById(id).value
        document.getElementById(id).value = "";

        //put item into list for client to see
        let item = document.createElement("li");
        item.appendChild(document.createTextNode(content));
        list.appendChild(item);

        //store item to send to database later
        data.addClassNote(id, content);
    });
});

document.querySelector(".save").addEventListener("click", event => {
    data.flush();
})