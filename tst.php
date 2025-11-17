<?php
// الحصول على التعبير الرياضي من URL
$expression = $_SERVER['QUERY_STRING'] ?? '';

// تنظيف التعبير من أي أحرف غير مرغوب فيها (للأمان)
// السماح فقط بالأرقام، العمليات الرياضية الأساسية، والأقواس
$expression = preg_replace('/[^0-9+\-*\/\(\)\.\s]/', '', $expression);

// التحقق من وجود تعبير
if (empty($expression)) {
    echo "يرجى إدخال تعبير رياضي في URL<br>";
    echo "مثال: tst.php?1+1";
    exit;
}

// تقييم التعبير الرياضي
try {
    // استخدام eval بشكل آمن نسبياً بعد التنظيف
    $result = eval("return $expression;");
    
    // عرض النتيجة
    echo "<h2>النتيجة:</h2>";
    echo "<p><strong>التعبير:</strong> $expression</p>";
    echo "<p><strong>النتيجة:</strong> $result</p>";
    
} catch (ParseError $e) {
    echo "<p style='color: red;'>خطأ في التعبير الرياضي: " . htmlspecialchars($expression) . "</p>";
} catch (Error $e) {
    echo "<p style='color: red;'>حدث خطأ: " . $e->getMessage() . "</p>";
}
?>

