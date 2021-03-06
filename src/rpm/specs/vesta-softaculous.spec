Name:           vesta-softaculous
Version:        1.0.0
Release:        1
Summary:        Vesta Control Panel
Group:          System Environment/Base
License:        Softaculous License
URL:            https://www.softaculous.com
Vendor:         vestacp.com
Source0:        %{name}-%{version}.tar.gz
BuildRoot:      %{_tmppath}/%{name}-%{version}-%{release}-root-%(%{__id_u} -n)
Requires:       vesta-ioncube
Provides:       vesta-softaculous

%define         _vestadir  /usr/local/vesta/softaculous

%description
This package contains Softaculous apps for Vesta Control Panel web interface.

%global debug_package %{nil}

%prep
%setup -q -n %{name}-%{version}

%build

%install
install -d  %{buildroot}%{_vestadir}
%{__cp} -ad ./* %{buildroot}%{_vestadir}

%clean
rm -rf %{buildroot}


%files
%defattr(-,root,root)
%attr(755,root,root) %{_vestadir}
%config(noreplace) %{_vestadir}/conf

%changelog
* Tue Nov 27 2018 Serghey Rodin <builder@vestacp.com> - 0.9.8-24
- New version 5.1.2

* Mon Jul 21 2017 Serghey Rodin <builder@vestacp.com> - 0.9.8-18
- Initial build for Softaculous 4.9.2
