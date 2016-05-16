function updateRoleAssign() {
    $(".role-assign").change(function () {
        $.post("/permission/update", {item: $(this).data("name"), role: $(this).data("role")}, function (data) {
            console.log(data);
        });
    });
}