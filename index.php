<?php
// index.php
// 이 파일은 웹 애플리케이션의 메인 진입점입니다.
// This file is the main entry point for the web application.

// 데이터베이스 연결을 위한 TODO (추후 구현 예정)
// TODO: Implement database connection for persistent storage

$submitted = false; // 제출 여부를 확인하는 변수 (Variable to check if form is submitted)
$score = 0;         // 점수를 저장할 변수 (Variable to store score)

// POST 요청(폼 제출)이 들어왔는지 확인합니다.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true; // 제출됨으로 상태 변경
    
    // 간단한 점수 계산 로직 (Simple scoring logic)
    // $_POST 배열에 담긴 제출된 데이터를 순회합니다.
    foreach ($_POST as $key => $value) {
        // 질문('q'로 시작하는 키)에 대해 'yes'라고 응답한 경우
        if (strpos($key, 'q') === 0 && $value == 'yes') {
            $score += 10; // 항목당 10점 추가 (Add 10 points per 'Yes')
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HSE 공급업체 평가 - PSA Busan</title>
    <link rel="stylesheet" href="style.css"> <!-- 스타일시트 연결 -->
</head>
<body>

<div class="container">
    <!-- 헤더 섹션: 제목 및 부제목 -->
    <header>
        <h1>HSE 공급업체 평가</h1>
        <div class="subtitle">보건, 안전 및 환경(HSE) 평가서</div>
        <p style="margin-top: 10px; font-weight: 500;">PSA Busan 참조: 공급업체 평가 / ISO 규정 준수</p>
    </header>

    <!-- 폼 제출 후 결과 화면 -->
    <?php if ($submitted): ?>
        <div class="card" style="border-top-color: var(--success-color); text-align: center;">
            <h2 style="color: var(--success-color);">평가가 성공적으로 제출되었습니다</h2>
            <p>HSE 평가를 완료해 주셔서 감사합니다.</p>
            <div style="font-size: 2rem; font-weight: bold; margin: 20px 0;">
                <!-- 계산된 점수 출력 -->
                상세 점수: <?php echo $score; ?> / 100
            </div>
            <!-- 다시 시작하기 버튼 -->
            <a href="index.php" class="submit-btn" style="text-decoration: none; display: inline-block; width: auto;">새 평가 작성</a>
        </div>
    <?php else: ?>
    <!-- 폼 제출 전 입력 화면 -->

    <form action="index.php" method="POST">
        
        <!-- 섹션 1: 일반 정보 (General Information) -->
        <div class="card">
            <h2>1. 일반 정보 (General Information)</h2>
            <div class="form-group">
                <label for="company_name">업체명 (Company Name)</label>
                <input type="text" id="company_name" name="company_name" required placeholder="업체명을 입력하세요">
            </div>
            <div class="form-group">
                <label for="representative">대표자 (Representative)</label>
                <input type="text" id="representative" name="representative" required placeholder="대표자 성명을 입력하세요">
            </div>
            <div class="form-group">
                <label for="date">일자 (Date)</label>
                <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>

        <!-- 섹션 2: HSE 경영 시스템 (ISO 인증) -->
        <div class="card">
            <h2>2. HSE 경영 시스템 (ISO 인증)</h2>
            <div class="info-box">
                귀사가 보유하고 있는 유효한 ISO 인증 여부를 체크해 주십시오.
            </div>
            
            <!-- 질문 2.1: ISO 14001 인증 여부 -->
            <div class="form-group">
                <label>2.1 귀사는 ISO 14001 인증을 보유하고 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q1" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q1" value="no"> 아니요 (No)</label>
                    <label class="radio-option"><input type="radio" name="q1" value="na"> 해당 없음 (N/A)</label>
                </div>
            </div>

            <!-- 질문 2.2: ISO 45001 인증 여부 -->
            <div class="form-group">
                <label>2.2 귀사는 ISO 45001 (또는 OHSAS 18001) 인증을 보유하고 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q2" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q2" value="no"> 아니요 (No)</label>
                    <label class="radio-option"><input type="radio" name="q2" value="na"> 해당 없음 (N/A)</label>
                </div>
            </div>
        </div>

        <!-- 섹션 3: HSE 정책 및 계획 -->
        <div class="card">
            <h2>3. HSE 정책 및 계획</h2>
            
            <div class="form-group">
                <label>3.1 CEO가 서명한 서면 HSE 정책을 보유하고 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q3" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q3" value="no"> 아니요 (No)</label>
                </div>
            </div>

            <div class="form-group">
                <label>3.2 HSE 목표가 수립되어 있으며 매년 모니터링되고 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q4" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q4" value="no"> 아니요 (No)</label>
                </div>
            </div>

             <div class="form-group">
                <label>3.3 위험성 평가(Risk Assessment) 절차가 마련되어 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q5" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q5" value="no"> 아니요 (No)</label>
                </div>
            </div>
        </div>

        <!-- 섹션 4: 교육 및 비상 대응 -->
        <div class="card">
            <h2>4. 교육 및 비상 대응</h2>
            
            <div class="form-group">
                <label>4.1 직원을 대상으로 정기적인 안전 교육을 실시하고 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q6" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q6" value="no"> 아니요 (No)</label>
                </div>
            </div>

            <div class="form-group">
                <label>4.2 비상 대응 매뉴얼(절차서)을 보유하고 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q7" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q7" value="no"> 아니요 (No)</label>
                </div>
            </div>

            <div class="form-group">
                <label>4.3 비상 대피 훈련을 주기적으로 실시합니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q8" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q8" value="no"> 아니요 (No)</label>
                </div>
            </div>
        </div>

        <!-- 섹션 5: 사고 보고 및 조사 -->
        <div class="card">
            <h2>5. 사고 보고 및 조사</h2>
            
            <div class="form-group">
                <label>5.1 사고 보고 및 조사에 대한 절차가 수립되어 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q9" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q9" value="no"> 아니요 (No)</label>
                </div>
            </div>

            <div class="form-group">
                <label>5.2 사고 기록을 최소 3년간 보관하고 있습니까?</label>
                <div class="radio-group">
                    <label class="radio-option"><input type="radio" name="q10" value="yes" required> 예 (Yes)</label>
                    <label class="radio-option"><input type="radio" name="q10" value="no"> 아니요 (No)</label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="remarks">추가 비고 / 의견 (Additional Remarks)</label>
                <textarea id="remarks" name="remarks" rows="4" placeholder="추가적인 설명이나 의견이 있다면 입력해 주세요..."></textarea>
            </div>
        </div>

        <button type="submit" class="submit-btn">평가 제출 (Submit Evaluation)</button>
    </form>
    <?php endif; ?>

    <footer>
        &copy; <?php echo date("Y"); ?> HSE Evaluation System. All rights reserved. | <a href="#" style="color: #666;">개인정보 처리방침</a>
    </footer>
</div>

</body>
</html>
