$(function () {
  const A = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  const a = "abcdefghijklmnopqrstuvwxyz";
  const num = "0123456789";
  const s = "~!@#$%^&*()_+{}|;:/<>";

  // 初始化
  function randomString(len, str) {
    len = len || 32;
    var maxPos = str.length;
    var pwd = "";
    for (i = 0; i < len; i++) {
      pwd += str.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
  }
  const str4 = A + a + num + s;
  const rDefault =
    randomString(1, A) +
    randomString(1, a) +
    randomString(1, num) +
    randomString(1, s) +
    randomString(2, str4);
  $(".head-title span").text(rDefault);

  // 校验
  var fv = $(".needs-validation").validate({
    errorElement: "div",
    errorClass: "invalid-feedback", // Use this class to create error labels, to look for existing error labels and to add it to invalid elements.
    errorPlacement: function (error, element) {
      // 验证失败调用的函数
      // error.addClass("invalid-feedback"); // 提示信息增加样式
      if (element.prop("type") === "checkbox") {
        error.insertAfter(element.parent("label")); // 待验证的元素如果是checkbox，错误提示放到label中
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("has-error"); // 验证失败时给元素增加样式
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("has-error"); // 验证成功时去掉元素的样式
    },
    rules: {
      length: {
        required: true,
        number: true
      }
    },
    submitHandler: function () {
      $(".needs-validation").removeClass("was-validated");

      return; // 校验通过
    }
  });
  $(".head-title i").click(function () {
    $(".needs-validation").addClass("was-validated");
    fv;
    var inputNum = $(".rule-0").val();
    if (inputNum >= 4) {
      const checked1 = $(".rule-1").prop("checked");
      const checked2 = $(".rule-2").prop("checked");
      const checked3 = $(".rule-3").prop("checked");
      const checked4 = $(".rule-4").prop("checked");
      const checked = [
        {
          class: ".rule-1",
          check: checked1,
          val: "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
        },
        {
          class: ".rule-2",
          check: checked2,
          val: "abcdefghijklmnopqrstuvwxyz"
        },
        {
          class: ".rule-3",
          check: checked3,
          val: "0123456789"
        },
        {
          class: ".rule-4",
          check: checked4,
          val: "~!@#$%^&*()_+{}|;:/<>"
        }
      ];
      let strStart = "";
      let str = "";
      let checkedNum = 0;
      for (let index = 0; index < checked.length; index++) {
        const element = checked[index];
        if (element.check === true) {
          str += element.val;
          checkedNum++;
          strStart += randomString(1, element.val);
        }
      }

      strEnd = randomString(inputNum - checkedNum, str);
      $(".head-title span").text(strStart + strEnd);
    }
  });

  //   复制密码
  $(".head-button button").click(function () {
    var span = $(".head-title span").text();
    var success = function () {
      alert("复制成功：" + span);
    };
    var error = function () {
      alert("复制失败！");
    };
    Clipboard.copy(span, success, error);
  });
});
