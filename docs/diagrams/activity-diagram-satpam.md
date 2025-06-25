# Gambar 3.2. Activity Diagram Satpam - Sistem Keamanan

```mermaid
flowchart TD
    Start([Start]) --> Login[Login Satpam]
    Login --> ValidateCredentials{Validate Credentials}
    
    ValidateCredentials -->|Invalid| LoginError[Show Login Error]
    LoginError --> Login
    
    ValidateCredentials -->|Valid| Dashboard[Access Security Dashboard]
    Dashboard --> MonitorMenu{Select Monitoring Activity}
    
    MonitorMenu -->|System Monitor| SystemCheck[Check System Status]
    MonitorMenu -->|Access Control| AccessControl[Monitor User Access]
    MonitorMenu -->|Security Audit| SecurityAudit[Perform Security Audit]
    MonitorMenu -->|Generate Report| GenerateReport[Generate Security Report]
    
    %% System Check Flow
    SystemCheck --> CheckServers[Check Server Status]
    CheckServers --> CheckDatabase[Check Database Connection]
    CheckDatabase --> CheckSecurity[Check Security Protocols]
    CheckSecurity --> SystemStatus{System Status OK?}
    
    SystemStatus -->|No| AlertAdmin[Send Alert to Admin]
    SystemStatus -->|Yes| LogSystemCheck[Log System Check]
    
    AlertAdmin --> LogSystemCheck
    LogSystemCheck --> BackToDashboard1[Back to Dashboard]
    
    %% Access Control Flow
    AccessControl --> ViewActiveUsers[View Active Users]
    ViewActiveUsers --> CheckSuspiciousActivity[Check Suspicious Activity]
    CheckSuspiciousActivity --> SuspiciousFound{Suspicious Activity Found?}
    
    SuspiciousFound -->|Yes| BlockAccess[Block Suspicious Access]
    SuspiciousFound -->|No| LogAccessCheck[Log Access Check]
    
    BlockAccess --> NotifyAdmin[Notify Admin]
    NotifyAdmin --> LogAccessCheck
    LogAccessCheck --> BackToDashboard2[Back to Dashboard]
    
    %% Security Audit Flow
    SecurityAudit --> CheckUserPermissions[Check User Permissions]
    CheckUserPermissions --> CheckDataIntegrity[Check Data Integrity]
    CheckDataIntegrity --> CheckLoginAttempts[Check Failed Login Attempts]
    CheckLoginAttempts --> AuditResults{Audit Results}
    
    AuditResults -->|Issues Found| CreateIncidentReport[Create Incident Report]
    AuditResults -->|All Clear| LogAuditComplete[Log Audit Complete]
    
    CreateIncidentReport --> LogAuditComplete
    LogAuditComplete --> BackToDashboard3[Back to Dashboard]
    
    %% Generate Report Flow
    GenerateReport --> SelectReportType{Select Report Type}
    
    SelectReportType -->|Daily| DailyReport[Generate Daily Security Report]
    SelectReportType -->|Weekly| WeeklyReport[Generate Weekly Security Report]
    SelectReportType -->|Monthly| MonthlyReport[Generate Monthly Security Report]
    
    DailyReport --> CompileData[Compile Security Data]
    WeeklyReport --> CompileData
    MonthlyReport --> CompileData
    
    CompileData --> FormatReport[Format Report]
    FormatReport --> SaveReport[Save Report to Database]
    SaveReport --> EmailReport[Email Report to Admin]
    EmailReport --> BackToDashboard4[Back to Dashboard]
    
    %% Back to Dashboard flows
    BackToDashboard1 --> ContinueMonitoring{Continue Monitoring?}
    BackToDashboard2 --> ContinueMonitoring
    BackToDashboard3 --> ContinueMonitoring
    BackToDashboard4 --> ContinueMonitoring
    
    ContinueMonitoring -->|Yes| MonitorMenu
    ContinueMonitoring -->|No| Logout[Logout]
    
    Logout --> End([End])
    
    %% Styling
    classDef startEnd fill:#e1f5fe
    classDef process fill:#f3e5f5
    classDef decision fill:#fff3e0
    classDef alert fill:#ffebee
    
    class Start,End startEnd
    class Login,Dashboard,SystemCheck,AccessControl,SecurityAudit,GenerateReport process
    class ValidateCredentials,MonitorMenu,SystemStatus,SuspiciousFound,AuditResults,SelectReportType,ContinueMonitoring decision
    class LoginError,AlertAdmin,BlockAccess,NotifyAdmin,CreateIncidentReport alert
```

## Deskripsi Activity Diagram Satpam

### Alur Utama Kegiatan Satpam:

1. **Login Process**
   - Satpam melakukan login dengan kredensial
   - Sistem memvalidasi kredensial
   - Jika tidak valid, tampilkan error dan kembali ke login
   - Jika valid, akses dashboard keamanan

2. **Dashboard Monitoring**
   - Satpam memilih aktivitas monitoring:
     - System Monitor
     - Access Control
     - Security Audit
     - Generate Report

3. **System Monitor**
   - Cek status server
   - Cek koneksi database
   - Cek protokol keamanan
   - Jika ada masalah, kirim alert ke admin
   - Log hasil pemeriksaan sistem

4. **Access Control**
   - Lihat pengguna yang sedang aktif
   - Cek aktivitas mencurigakan
   - Jika ditemukan aktivitas mencurigakan:
     - Block akses
     - Notifikasi admin
   - Log pemeriksaan akses

5. **Security Audit**
   - Cek permission pengguna
   - Cek integritas data
   - Cek percobaan login yang gagal
   - Jika ditemukan masalah, buat incident report
   - Log audit selesai

6. **Generate Report**
   - Pilih tipe laporan (Daily/Weekly/Monthly)
   - Compile data keamanan
   - Format laporan
   - Simpan ke database
   - Email laporan ke admin

7. **Continue or Logout**
   - Satpam dapat melanjutkan monitoring atau logout
   - Jika logout, sesi berakhir

### Fitur Keamanan:
- **Real-time Monitoring**: Pemantauan sistem secara real-time
- **Automated Alerts**: Alert otomatis untuk admin
- **Incident Reporting**: Pelaporan insiden keamanan
- **Access Control**: Kontrol akses pengguna
- **Audit Trail**: Jejak audit untuk semua aktivitas