<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📝 프로젝트 평가 기준표</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #ffeef8 0%, #f8e8ff 25%, #e8f0ff 50%, #f0e8ff 75%, #ffeef8 100%);
            background-size: 400% 400%;
            animation: gradientFlow 20s ease infinite;
            color: #2d1b3d;
            min-height: 100vh;
            padding: 20px;
            position: relative;
        }
        
        @keyframes gradientFlow {
            0%, 100% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
        }
        
        .container {
            max-width: 1500px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #c084fc, #f472b6, #a855f7);
            color: white;
            padding: 40px;
            text-align: center;
            border-radius: 30px 30px 0 0;
            position: relative;
        }
        
        .header h1 {
            font-size: 3.2em;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }
        
        .header p {
            font-size: 1.2em;
            margin-top: 15px;
            opacity: 0.9;
            font-weight: 500;
        }
        
        .evaluation-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .evaluation-table thead tr {
            background: linear-gradient(135deg, #c084fc, #a855f7) !important;
            color: white;
        }
        
        .evaluation-table th {
            padding: 20px 15px;
            font-weight: 700;
            font-size: 1.1em;
        }
        
        .category-row {
            background: linear-gradient(135deg, rgba(248, 232, 255, 0.7), rgba(233, 213, 255, 0.5));
        }
        
        .category-cell {
            padding: 25px 20px;
            font-weight: 700;
            font-size: 1.3em;
            color: #7c3aed;
            border-bottom: 2px solid rgba(196, 181, 253, 0.3);
            vertical-align: top;
            width: 120px;
        }
        
        .content-cell {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(196, 181, 253, 0.2);
            vertical-align: top;
            width: 450px;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
        }
        
        .criteria-cell {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(196, 181, 253, 0.2);
            vertical-align: top;
            width: 300px;
            background: linear-gradient(135deg, rgba(243, 232, 255, 0.6), rgba(221, 214, 254, 0.4));
            backdrop-filter: blur(15px);
        }
        
        .score-cell {
            padding: 25px 20px;
            text-align: center;
            vertical-align: top;
            border-bottom: 1px solid rgba(196, 181, 253, 0.2);
            width: 200px;
            background: rgba(253, 250, 255, 0.6);
            backdrop-filter: blur(15px);
        }
        
        .question {
            margin-bottom: 20px;
            padding: 20px;
            background: linear-gradient(135deg, rgba(248, 232, 255, 0.8), rgba(233, 213, 255, 0.6));
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(196, 181, 253, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .question:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        
        .question:last-child {
            margin-bottom: 0;
        }
        
        .criteria-list {
            background: linear-gradient(135deg, rgba(243, 232, 255, 0.7), rgba(221, 214, 254, 0.5));
            backdrop-filter: blur(15px);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid rgba(196, 181, 253, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .criteria-list:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }
        
        .criteria-item {
            margin-bottom: 12px;
            color: #6366f1;
            font-size: 0.95em;
            font-weight: 500;
        }
        
        .criteria-item:last-child {
            margin-bottom: 0;
        }
        
        .likert-scale {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .likert-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 12px 8px;
            border-radius: 15px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.4), rgba(248, 232, 255, 0.2));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(196, 181, 253, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .likert-option:hover {
            transform: translateY(-3px) scale(1.05);
            background: linear-gradient(135deg, rgba(244, 114, 182, 0.2), rgba(192, 132, 252, 0.2));
            box-shadow: 0 8px 25px rgba(244, 114, 182, 0.2);
        }
        
        .likert-option input[type="radio"] {
            margin-bottom: 8px;
            transform: scale(1.3);
            accent-color: #a78bfa;
        }
        
        .likert-option label {
            font-size: 0.85em;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            color: #5b21b6;
            line-height: 1.2;
        }
        
        .individual-score {
            font-size: 1.2em;
            font-weight: 700;
            color: #7c3aed;
            margin-top: 15px;
            text-align: center;
        }
        
        .score-display {
            font-size: 1.4em;
            font-weight: 800;
            color: #8b5cf6;
            margin-bottom: 10px;
        }
        
        .average-display {
            font-size: 1.2em;
            color: #7c3aed;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .total-score {
            background: linear-gradient(135deg, #c084fc, #a78bfa, #8b5cf6) !important;
            color: white;
            font-size: 1.8em;
            font-weight: bold;
        }
        
        .reset-btn {
            background: linear-gradient(135deg, #f472b6, #c084fc);
            color: white;
            border: none;
            padding: 18px 35px;
            font-size: 1.2em;
            font-weight: 600;
            border-radius: 25px;
            cursor: pointer;
            margin: 30px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(244, 114, 182, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }
        
        .reset-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 12px 35px rgba(244, 114, 182, 0.4);
            background: linear-gradient(135deg, #ec4899, #a855f7);
        }
        
        .reset-btn:active {
            transform: translateY(-2px) scale(1.02);
        }
        
        .score-breakdown {
            font-size: 0.95em;
            line-height: 1.6;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid rgba(196, 181, 253, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }
        
        hr {
            margin: 15px 0;
            border: none;
            height: 2px;
            background: linear-gradient(135deg, rgba(196, 181, 253, 0.4), rgba(244, 114, 182, 0.3));
            border-radius: 2px;
        }
        
        /* 스크롤바 스타일링 */
        ::-webkit-scrollbar {
            width: 12px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #f472b6, #c084fc);
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #ec4899, #a855f7);
        }
        
        /* 반응형 */
        @media (max-width: 768px) {
            .container { 
                margin: 10px;
                border-radius: 20px;
            }
            .header h1 { 
                font-size: 2.5em; 
            }
            .evaluation-table {
                font-size: 0.9em;
            }
            .category-cell {
                font-size: 1.1em;
            }
            .likert-scale {
                gap: 8px;
            }
            .likert-option {
                padding: 8px 6px;
            }
            .reset-btn { 
                display: block; 
                width: calc(100% - 60px);
                margin: 30px;
            }
        }
        
        /* 부드러운 파티클 효과를 위한 추가 스타일 */
        .particle {
            position: fixed;
            pointer-events: none;
            z-index: 0;
        }
        
        @keyframes softFloat {
            0% {
                transform: translateY(100vh) rotate(0deg) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
                transform: scale(1);
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg) scale(0);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📝 프로젝트 평가 기준표</h1>
            <p>각 항목을 5점 척도로 평가해주세요</p>
        </div>
        
        <table class="evaluation-table">
            <thead>
                <tr>
                    <th>평가 항목</th>
                    <th>세부 내용</th>
                    <th>세부 평가 기준</th>
                    <th>점수 및 배점</th>
                </tr>
            </thead>
            <tbody>
                <!-- 전문성 -->
                <tr class="category-row">
                    <td class="category-cell" rowspan="3">전문성</td>
                    <td class="content-cell">
                        <div class="question">
                            프로젝트의 보안 기능이 기술적으로 정확하게 구현되어있는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q1" value="1" id="q1-1">
                                    <label for="q1-1">매우<br>부족<br>(2점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q1" value="2" id="q1-2">
                                    <label for="q1-2">부족<br>(4점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q1" value="3" id="q1-3">
                                    <label for="q1-3">보통<br>(6점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q1" value="4" id="q1-4">
                                    <label for="q1-4">우수<br>(8점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q1" value="5" id="q1-5">
                                    <label for="q1-5">매우<br>우수<br>(10점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q1">0 / 10점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                    <td class="score-cell" rowspan="3">
                        <div class="score-breakdown">
                            <div class="score-display">총점: <span id="total-전문성">0</span> / 30점</div>
                            <div class="average-display">평균: <span id="average-전문성">0.0</span> / 5.0</div>
                            <hr>
                            <div style="font-size: 0.8em; color: #7c3aed; font-weight: 600;">
                                세부 점수:<br>
                                • 기술적 구현: <span id="detail-q1">0</span>/10점<br>
                                • 보안 원리: <span id="detail-q2">0</span>/10점<br>
                                • 기술 활용: <span id="detail-q3">0</span>/10점
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="content-cell">
                        <div class="question">
                            보안 원리(인증, 암호화, 탐지, 대응 등)가 적절히 적용되어있는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q2" value="1" id="q2-1">
                                    <label for="q2-1">매우<br>부족<br>(2점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q2" value="2" id="q2-2">
                                    <label for="q2-2">부족<br>(4점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q2" value="3" id="q2-3">
                                    <label for="q2-3">보통<br>(6점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q2" value="4" id="q2-4">
                                    <label for="q2-4">우수<br>(8점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q2" value="5" id="q2-5">
                                    <label for="q2-5">매우<br>우수<br>(10점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q2">0 / 10점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="content-cell">
                        <div class="question">
                            사용된 보안 기술·도구가 목적에 맞게 활용되어있는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q3" value="1" id="q3-1">
                                    <label for="q3-1">매우<br>부족<br>(2점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q3" value="2" id="q3-2">
                                    <label for="q3-2">부족<br>(4점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q3" value="3" id="q3-3">
                                    <label for="q3-3">보통<br>(6점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q3" value="4" id="q3-4">
                                    <label for="q3-4">우수<br>(8점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q3" value="5" id="q3-5">
                                    <label for="q3-5">매우<br>우수<br>(10점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q3">0 / 10점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                </tr>
                
                <!-- 차별성 -->
                <tr class="category-row">
                    <td class="category-cell" rowspan="3">차별성</td>
                    <td class="content-cell">
                        <div class="question">
                            기존 보안 솔루션이나 사례와 구별되는 새로운 시각이나 접근 방식을 제시했는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q4" value="1" id="q4-1">
                                    <label for="q4-1">매우<br>부족<br>(2점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q4" value="2" id="q4-2">
                                    <label for="q4-2">부족<br>(4점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q4" value="3" id="q4-3">
                                    <label for="q4-3">보통<br>(6점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q4" value="4" id="q4-4">
                                    <label for="q4-4">우수<br>(8점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q4" value="5" id="q4-5">
                                    <label for="q4-5">매우<br>우수<br>(10점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q4">0 / 10점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                    <td class="score-cell" rowspan="3">
                        <div class="score-breakdown">
                            <div class="score-display">총점: <span id="total-차별성">0</span> / 30점</div>
                            <div class="average-display">평균: <span id="average-차별성">0.0</span> / 5.0</div>
                            <hr>
                            <div style="font-size: 0.8em; color: #7c3aed; font-weight: 600;">
                                세부 점수:<br>
                                • 새로운 접근: <span id="detail-q4">0</span>/10점<br>
                                • 창의적 해결: <span id="detail-q5">0</span>/10점<br>
                                • 기술적 혁신: <span id="detail-q6">0</span>/10점
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="content-cell">
                        <div class="question">
                            실제 보안 문제에 대한 해결 아이디어가 실질적이고 창의적인가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q5" value="1" id="q5-1">
                                    <label for="q5-1">매우<br>부족<br>(2점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q5" value="2" id="q5-2">
                                    <label for="q5-2">부족<br>(4점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q5" value="3" id="q5-3">
                                    <label for="q5-3">보통<br>(6점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q5" value="4" id="q5-4">
                                    <label for="q5-4">우수<br>(8점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q5" value="5" id="q5-5">
                                    <label for="q5-5">매우<br>우수<br>(10점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q5">0 / 10점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="content-cell">
                        <div class="question">
                            문제 해결을 위해 새로운 시도나 기술적·기획적 혁신이 이루어졌는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q6" value="1" id="q6-1">
                                    <label for="q6-1">매우<br>부족<br>(2점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q6" value="2" id="q6-2">
                                    <label for="q6-2">부족<br>(4점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q6" value="3" id="q6-3">
                                    <label for="q6-3">보통<br>(6점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q6" value="4" id="q6-4">
                                    <label for="q6-4">우수<br>(8점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q6" value="5" id="q6-5">
                                    <label for="q6-5">매우<br>우수<br>(10점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q6">0 / 10점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                </tr>
                
                <!-- 완성도 -->
                <tr class="category-row">
                    <td class="category-cell" rowspan="2">완성도</td>
                    <td class="content-cell">
                        <div class="question">
                            보안 시스템(공격-탐지-대응)의 구조가 논리적으로 설계되고 각 단계가 유기적으로 작동하는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q7" value="1" id="q7-1">
                                    <label for="q7-1">매우<br>부족<br>(3점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q7" value="2" id="q7-2">
                                    <label for="q7-2">부족<br>(6점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q7" value="3" id="q7-3">
                                    <label for="q7-3">보통<br>(9점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q7" value="4" id="q7-4">
                                    <label for="q7-4">우수<br>(12점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q7" value="5" id="q7-5">
                                    <label for="q7-5">매우<br>우수<br>(15점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q7">0 / 15점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                    <td class="score-cell" rowspan="2">
                        <div class="score-breakdown">
                            <div class="score-display">총점: <span id="total-완성도">0</span> / 30점</div>
                            <div class="average-display">평균: <span id="average-완성도">0.0</span> / 5.0</div>
                            <hr>
                            <div style="font-size: 0.8em; color: #7c3aed; font-weight: 600;">
                                세부 점수:<br>
                                • 시스템 설계: <span id="detail-q7">0</span>/15점<br>
                                • 기능 완성도: <span id="detail-q8">0</span>/15점
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="content-cell">
                        <div class="question">
                            프로젝트의 주요 기능이 안정적으로 동작하며, 로그 수집·분석 등 세부 기능이 체계적으로 완성되어있는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q8" value="1" id="q8-1">
                                    <label for="q8-1">매우<br>부족<br>(3점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q8" value="2" id="q8-2">
                                    <label for="q8-2">부족<br>(6점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q8" value="3" id="q8-3">
                                    <label for="q8-3">보통<br>(9점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q8" value="4" id="q8-4">
                                    <label for="q8-4">우수<br>(12점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q8" value="5" id="q8-5">
                                    <label for="q8-5">매우<br>우수<br>(15점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q8">0 / 15점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                </tr>
                
                <!-- 발표 및 시연 역량 -->
                <tr class="category-row">
                    <td class="category-cell" rowspan="2">발표 및<br>시연 역량</td>
                    <td class="content-cell">
                        <div class="question">
                            프로젝트의 핵심 개념과 기술 구현 과정을 명확하고 논리적으로 설명했는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q9" value="1" id="q9-1">
                                    <label for="q9-1">매우<br>부족<br>(1점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q9" value="2" id="q9-2">
                                    <label for="q9-2">부족<br>(2점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q9" value="3" id="q9-3">
                                    <label for="q9-3">보통<br>(3점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q9" value="4" id="q9-4">
                                    <label for="q9-4">우수<br>(4점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q9" value="5" id="q9-5">
                                    <label for="q9-5">매우<br>우수<br>(5점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q9">0 / 5점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                    <td class="score-cell" rowspan="2">
                        <div class="score-breakdown">
                            <div class="score-display">총점: <span id="total-발표">0</span> / 10점</div>
                            <div class="average-display">평균: <span id="average-발표">0.0</span> / 5.0</div>
                            <hr>
                            <div style="font-size: 0.8em; color: #7c3aed; font-weight: 600;">
                                세부 점수:<br>
                                • 논리적 설명: <span id="detail-q9">0</span>/5점<br>
                                • 효과적 전달: <span id="detail-q10">0</span>/5점
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="content-cell">
                        <div class="question">
                            시각 자료, 시연 구성, 발표 언어를 효과적으로 활용하여 핵심 메시지를 전달했는가?
                            <div class="likert-scale">
                                <div class="likert-option">
                                    <input type="radio" name="q10" value="1" id="q10-1">
                                    <label for="q10-1">매우<br>부족<br>(1점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q10" value="2" id="q10-2">
                                    <label for="q10-2">부족<br>(2점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q10" value="3" id="q10-3">
                                    <label for="q10-3">보통<br>(3점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q10" value="4" id="q10-4">
                                    <label for="q10-4">우수<br>(4점)</label>
                                </div>
                                <div class="likert-option">
                                    <input type="radio" name="q10" value="5" id="q10-5">
                                    <label for="q10-5">매우<br>우수<br>(5점)</label>
                                </div>
                            </div>
                            <div class="individual-score" id="individual-q10">0 / 5점</div>
                        </div>
                    </td>
                    <td class="criteria-cell">
                        <div class="criteria-list">
                            <div class="criteria-item">1) </div>
                            <div class="criteria-item">2) </div>
                            <div class="criteria-item">3) </div>
                            <div class="criteria-item">4) </div>
                        </div>
                    </td>
                </tr>
                
                <!-- 총합 -->
                <tr class="total-score">
                    <td style="padding: 25px; text-align: center;">총합</td>
                    <td style="padding: 25px; text-align: center;">전체 평균: <span id="overall-average">0.0</span> / 5.0</td>
                    <td style="padding: 25px; text-align: center;">-</td>
                    <td style="padding: 25px; text-align: center;">
                        <div id="final-total-score">0</div>
                        <div style="font-size: 0.8em; margin-top: 5px;">/ 100점</div>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div style="text-align: center; padding: 20px;">
            <button class="reset-btn" onclick="resetAll()">🔄 전체 초기화</button>
        </div>
    </div>

    <script>
        const categories = {
            '전문성': {
                questions: [
                    {name: 'q1', maxPoints: 10},
                    {name: 'q2', maxPoints: 10},
                    {name: 'q3', maxPoints: 10}
                ],
                totalMaxScore: 30
            },
            '차별성': {
                questions: [
                    {name: 'q4', maxPoints: 10},
                    {name: 'q5', maxPoints: 10},
                    {name: 'q6', maxPoints: 10}
                ],
                totalMaxScore: 30
            },
            '완성도': {
                questions: [
                    {name: 'q7', maxPoints: 15},
                    {name: 'q8', maxPoints: 15}
                ],
                totalMaxScore: 30
            },
            '발표': {
                questions: [
                    {name: 'q9', maxPoints: 5},
                    {name: 'q10', maxPoints: 5}
                ],
                totalMaxScore: 10
            }
        };

        function calculateIndividualScore(likertValue, maxPoints) {
            return Math.round((likertValue / 5) * maxPoints);
        }

        function calculateScore() {
            let totalScore = 0;
            let totalQuestions = 0;
            let totalLikertSum = 0;
            
            for (const [categoryName, categoryData] of Object.entries(categories)) {
                let categoryScore = 0;
                let categoryLikertSum = 0;
                let answeredQuestions = 0;
                
                categoryData.questions.forEach(question => {
                    const selectedOption = document.querySelector(`input[name="${question.name}"]:checked`);
                    let individualScore = 0;
                    
                    if (selectedOption) {
                        const likertValue = parseInt(selectedOption.value);
                        individualScore = calculateIndividualScore(likertValue, question.maxPoints);
                        categoryScore += individualScore;
                        categoryLikertSum += likertValue;
                        answeredQuestions++;
                        totalLikertSum += likertValue;
                        totalQuestions++;
                    }
                    
                    const individualElement = document.getElementById(`individual-${question.name}`);
                    const detailElement = document.getElementById(`detail-${question.name}`);
                    
                    if (individualElement) {
                        individualElement.textContent = `${individualScore} / ${question.maxPoints}점`;
                    }
                    if (detailElement) {
                        detailElement.textContent = individualScore;
                    }
                });
                
                const categoryAverage = answeredQuestions > 0 ? (categoryLikertSum / answeredQuestions).toFixed(1) : '0.0';
                
                const totalElement = document.getElementById(`total-${categoryName}`);
                const averageElement = document.getElementById(`average-${categoryName}`);
                
                if (totalElement) {
                    totalElement.textContent = categoryScore;
                }
                if (averageElement) {
                    averageElement.textContent = categoryAverage;
                }
                
                totalScore += categoryScore;
            }
            
            const overallAverage = totalQuestions > 0 ? (totalLikertSum / totalQuestions).toFixed(1) : '0.0';
            
            const finalTotalElement = document.getElementById('final-total-score');
            const overallAverageElement = document.getElementById('overall-average');
            
            if (finalTotalElement) {
                finalTotalElement.textContent = totalScore;
            }
            if (overallAverageElement) {
                overallAverageElement.textContent = overallAverage;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    calculateScore();
                });
            });
            
            // 부드러운 파티클 효과 생성
            createSoftParticles();
        });

        function resetAll() {
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.checked = false;
            });
            
            for (const [categoryName, categoryData] of Object.entries(categories)) {
                const totalElement = document.getElementById(`total-${categoryName}`);
                const averageElement = document.getElementById(`average-${categoryName}`);
                
                if (totalElement) totalElement.textContent = '0';
                if (averageElement) averageElement.textContent = '0.0';
                
                categoryData.questions.forEach(question => {
                    const individualElement = document.getElementById(`individual-${question.name}`);
                    const detailElement = document.getElementById(`detail-${question.name}`);
                    
                    if (individualElement) {
                        individualElement.textContent = `0 / ${question.maxPoints}점`;
                    }
                    if (detailElement) {
                        detailElement.textContent = '0';
                    }
                });
            }
            
            const finalTotalElement = document.getElementById('final-total-score');
            const overallAverageElement = document.getElementById('overall-average');
            
            if (finalTotalElement) finalTotalElement.textContent = '0';
            if (overallAverageElement) overallAverageElement.textContent = '0.0';
        }

        // 부드러운 파티클 효과
        function createSoftParticles() {
            const particleContainer = document.createElement('div');
            particleContainer.style.position = 'fixed';
            particleContainer.style.top = '0';
            particleContainer.style.left = '0';
            particleContainer.style.width = '100%';
            particleContainer.style.height = '100%';
            particleContainer.style.pointerEvents = 'none';
            particleContainer.style.zIndex = '0';
            document.body.appendChild(particleContainer);

            for (let i = 0; i < 12; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.position = 'absolute';
                particle.style.width = Math.random() * 6 + 3 + 'px';
                particle.style.height = particle.style.width;
                
                const colors = [
                    'rgba(244, 114, 182, 0.3)',
                    'rgba(192, 132, 252, 0.3)',
                    'rgba(168, 85, 247, 0.3)',
                    'rgba(236, 72, 153, 0.3)',
                    'rgba(139, 92, 246, 0.3)'
                ];
                
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.backdropFilter = 'blur(2px)';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animation = `softFloat ${Math.random() * 25 + 30}s infinite linear`;
                
                particleContainer.appendChild(particle);
            }
        }
    </script>
</body>
</html>
